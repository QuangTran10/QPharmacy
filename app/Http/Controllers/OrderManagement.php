<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
use PDF;
session_start();

class OrderManagement extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function order_management(){
        $this->AuthLogin();
    	$all_order=DB::table('dathang')->orderBy('SoDonDH','desc')->get();
        $count = DB::table('dathang')->where('TinhTrang',0)->get()->count();
    	Session::put('page',5);
    	return view('admin.Order.order_management')->with('all_order',$all_order)->with('count_order_process',$count);
    }

    public function count_order(){
        $data = array();
        $count = DB::table('dathang')->where('TinhTrang',0)->get()->count();
        $all_order=DB::table('dathang')->where('TinhTrang',0)->orderBy('SoDonDH','desc')->get();

        $data['count']=$count;
        
        $data['contend']='';
        if ($count!=0) {
            foreach ($all_order as $key => $value) {
                $content=$value->SoDonDH.' - '.$value->HoTen.'    '.$value->NgayDH;
                $url='/view_order/'.$value->SoDonDH;
                $data['contend'].='<a class="dropdown-item" href=" '.url($url).'">'.$content.'</a>';
            }
        }else{
            $data['contend'].='<a class="dropdown-item" >Không có thông báo nào </a>';
        }
        
        echo json_encode($data);
    }

    public function view_order($SoDonDH){
        $this->AuthLogin();
    	$order_by_id=DB::table('dathang')
    	->join('khachhang', 'dathang.MSKH', '=', 'khachhang.MSKH')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('dathang.SoDonDH',$SoDonDH)
        ->select('dathang.*', 'thanhtoan.*')->get();

    	$order_details=DB::table('chitietdathang')
        ->join('hanghoa', 'chitietdathang.MSHH', '=', 'hanghoa.MSHH')
        ->where('SoDonDH',$SoDonDH)->get();

    	return view('admin.Order.view_order')
        ->with('order_by_id',$order_by_id)->with('order_details',$order_details)
        ->with('SoDonDH',$SoDonDH);
    }

    public function update_status(Request $request){
    	$SoDonDH=$request->SoDonDH;
        $MSNV=Session::get('admin_id');
        $result=DB::table('dathang')->where('SoDonDH',$SoDonDH)->update(['TinhTrang'=> 1, 'MSNV'=>$MSNV]);
        if($result){
           return Redirect::to('/order_management');
        }else{
           return redirect('/view_order/'.$SoDonDH)->with('notice','Cập nhật Không thành công');
        }
    }
    public function print_order($checkout_code){
        $this->AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data=array();
        $contact = DB::table('lienhe')->get();

        $order_by_id=DB::table('dathang')
        ->join('khachhang', 'dathang.MSKH', '=', 'khachhang.MSKH')
        ->where('dathang.SoDonDH',$checkout_code)->get();

        $order_details=DB::table('chitietdathang')
        ->join('hanghoa', 'chitietdathang.MSHH', '=', 'hanghoa.MSHH')
        ->where('SoDonDH',$checkout_code)->get();

        $data['URL']='public/frontend/assets/img/logo_brand.png';
        $data['order']=$order_by_id;
        $data['order_details']=$order_details;
        $data['contact']=$contact;

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.Order.invoice', $data);
        $name="Invoice_".$checkout_code."_".$now->day.$now->month.$now->year.".pdf";
        return $pdf->stream($name);
    }

    //USER

    public function show_order(Request $re){
        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();

        $MSKH=Session::get('user_id');
        //Các đơn hàng chưa xử lý
        $orders_process = DB::table('dathang')->where('MSKH',$MSKH)->where('TinhTrang',0)->get();
        //Các đơn hàng đang giao hàng
        $orders_shipping = DB::table('dathang')->where('MSKH',$MSKH)->where('TinhTrang',1)->get();
        //Các đơn hàng đã nhận hàng
        $orders_delivered = DB::table('dathang')->where('MSKH',$MSKH)->where('TinhTrang',2)->get();
        //Các đơn hàng đã huỷ
        $orders_cancel = DB::table('dathang')->where('MSKH',$MSKH)->where('TinhTrang',3)->get();

        $meta_desc="Thông Tin Đơn Hàng";
        $meta_keywords="Show Order";
        $meta_tittle="QPharmacy";
        $url=$re->url();
        return view('pages.check_out.show_order')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('orders_process',$orders_process)->with('orders_shipping',$orders_shipping)
        ->with('orders_delivered',$orders_delivered)->with('orders_cancel',$orders_cancel);
    }
    public function order_detail($id_order, Request $re){
        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();

        $order_de = DB::table('chitietdathang')
        ->join('hanghoa', 'hanghoa.MSHH', '=', 'chitietdathang.MSHH')
        ->where('chitietdathang.SoDonDH',$id_order)->get();

        $order= DB::table('dathang')
        ->join('thanhtoan', 'thanhtoan.MaThanhToan', '=', 'dathang.MaThanhToan')
        ->where('dathang.SoDonDH',$id_order)->first();

        $meta_desc="Chi Tiết Đơn Hàng";
        $meta_keywords="Show Order Details - ".$id_order;
        $meta_tittle="QPharmacy";
        $url=$re->url();

        return view('pages.check_out.order_detail')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('order_details',$order_de)->with('order',$order);
    }
    public function update_order(Request $re){
        $status = $re->TinhTrang;
        $SoDonDH= $re->SoDonDH;
        $result = DB::table('dathang')->where('SoDonDH',$SoDonDH)->update(['TinhTrang' => $status]);
        if ($status==3) {
            DB::table("chitietdathang")->where('SoDonDH',$SoDonDH)->delete();
        }
        if($result){
            return Redirect::to('/show_order');
        }
    }
}
