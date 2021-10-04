<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Carbon\Carbon;
use Session;
session_start();

class CheckOutController extends Controller
{
    public function check_out(Request $re){
    	$MSKH=Session::get('user_id');
    	$all_address_by_id=DB::table('diachikh')->where('MSKH',$MSKH)->get();
    	$all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();

        //Seo
        $meta_desc="Thanh Toán Đơn Hàng";
        $meta_keywords="CheckOut";
        $meta_tittle="QPharmacy";
        $url=$re->url();
        // end seo

    	return view('pages.check_out.check_out')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('all_address_by_id',$all_address_by_id)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_tittle',$meta_tittle)->with('url',$url);
    }

    public function save_check_out(Request $re){
    	$content =  Session::get('cart');
    	$MSKH=Session::get('user_id');
    	//Lấy dữ liệu từ bảng diachikh
    	$MaDC=$re->DiaChi;
    	$address_info=DB::table('diachikh')->where('MaDC',$MaDC)->get();
    	foreach ($address_info as $key => $value) {
    		$HoTen=$value->HoTen;
    		$SDT=$value->SDT;
    		$DiaChi=$value->DiaChi;
    	}

    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$data=array();
        $order=array();

        //insert table dathang
    	$data['MSKH']=$MSKH;
    	$data['MSNV']=NULL;
    	$data['ThanhTien']=0;
    	$data['HoTen']=$HoTen;
    	$data['SDT']=$SDT;
    	$data['DiaChiGH']=$DiaChi;
    	$data['NgayDH']=$now;
    	$data['NgayGH']=NULL;
    	$data['LoaiGH']=$re->paymentmethod;
    	$data['TinhTrang']=0;
    	$data['TG_Tao']=$now;
    	$data['TG_CapNhat']=$now;
        $total=0;
        
        if($re->check==1){
            $SoDonDH=DB::table('dathang')->insertGetId($data);
            //insert table chitietdathang
            foreach ($content as $v_content) {
                $order['SoDonDH']=$SoDonDH;
                $order['MSHH']=$v_content['product_id'];
                $order['SoLuong']=$v_content['product_qty'];
                $order['GiamGia']=0;
                $order['GiaDatHang']=$v_content['product_price'];
                $order['ThanhTien']=($v_content['product_price']*$v_content['product_qty']);
                $total=$total+$v_content['product_price']*$v_content['product_qty'];
                $result=DB::table('chitietdathang')->insert($order);
            }   
            if($total<1000000){
                $total = $total +30000;
            }
            if ($result) {
                DB::table('dathang')->where('SoDonDH',$SoDonDH)->update(['ThanhTien' => $total]);
                Session::put('cart',null);
                return Redirect::to('/trang_chu');
            }else{
                return redirect('/check_out')->with('notice','Thanh Toán Thất Bại');
            }
        }
    	
    }

    public function shipping_add(Request $request){
    	$MSKH=Session::get('user_id');
    	$data=array();
    	$data['HoTen']=$request->HoTen;
    	$data['SDT']=$request->SDT;
    	$data['DiaChi']=$request->DiaChi;
    	$data['MSKH']=$MSKH;
    	DB::table('diachikh')->insert($data);
    	return Redirect::to('/check_out');
    }
}
