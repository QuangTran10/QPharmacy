<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
session_start();

class OrderManagement extends Controller
{
    public function order_management(){
    	$all_order=DB::table('dathang')->get();
    	Session::put('page',5);
    	return view('admin.Order.order_management')->with('all_order',$all_order);
    }

    public function view_order($SoDonDH){
    	$order_by_id=DB::table('dathang')
    	->join('khachhang', 'dathang.MSKH', '=', 'khachhang.MSKH')->where('dathang.SoDonDH',$SoDonDH)->get();
    	$order_details=DB::table('chitietdathang')->join('hanghoa', 'chitietdathang.MSHH', '=', 'hanghoa.MSHH')->where('SoDonDH',$SoDonDH)->get();
    	return view('admin.Order.view_order')
        ->with('order_by_id',$order_by_id)->with('order_details',$order_details)
        ->with('SoDonDH',$SoDonDH);
    }

    public function update_status(Request $request){
    	$sta = DB::table('dathang')->select('TinhTrang')->get();
    	$SoDonDH=$request->SoDonDH;
        $MSNV=Session::get('admin_id');
    	foreach ($sta as $u) {
    		$Status=$u->TinhTrang;
    	}
    	if ($Status==0) {
    		$TrangThai= $request->TinhTrang;
    		$result=DB::table('dathang')->where('SoDonDH',$SoDonDH)->update(['TinhTrang'=> $TrangThai, 'MSNV'=>$MSNV]);
    		if($result){
    			return Redirect::to('/order_management');
    		}else{
    			return redirect('/view_order/'.$SoDonDH)->with('notice','Cập nhật Không thành công');
    		}
    	}else{
    		return redirect('/view_order/'.$SoDonDH)->with('notice','Đơn Hàng đã được cập nhật');
    	}
    }

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

        $order= DB::table('dathang')->where('SoDonDH',$id_order)->get();

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
        if($result){
            return Redirect::to('/show_order');
        }
    }
}
