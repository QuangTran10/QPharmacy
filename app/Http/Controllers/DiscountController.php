<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class DiscountController extends Controller
{
    //ADMIN
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function show_discount(){
    	$this->AuthLogin();
    	Session::put('page',9);
        $coupon = DB::table('magiamgia')->get();
    	return view('admin.Discount.discount_management',compact('coupon'));
    }

    public function select_discount(Request $re){
        $option = $re->option;
        $array;
        $output=array();
        if ($option==0) {
            $array=DB::table('loaihanghoa')->where('TinhTrang',1)->orderBy('MaLoaiHang','ASC')->select('MaLoaiHang','TenLoaiHang')->get();
            foreach ($array as $key => $value) {
                $output[] = array(
                    'ID'  =>$value->MaLoaiHang,
                    'Name'=>$value->TenLoaiHang
                );
            }
        }else{
            $array=DB::table('hanghoa')->where('TrangThai',1)->orderBy('MSHH','ASC')->select('MSHH','TenHH')->get();
            foreach ($array as $key => $value) {
                $output[] = array(
                    'ID'  =>$value->MSHH,
                    'Name'=>$value->TenHH
                );
            }
        }
        return response()->json($output);
    }

    public function add_coupon(){
        return view('admin.Discount.add_coupon');
    }

    public function delete_coupon($MaGiam){
        $coupon = DB::table('magiamgia')->where('MaGiamGia',$MaGiam)->delete();

        $coupon_detail = DB::table('chitietgiamgia')->where('MaGiam',$MaGiam)->delete();

        return Redirect::to('/show_discount');
    }

    //Thêm coupon
    public function save_coupon(Request $re){
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        $option=$re->LoaiGiamGia;
        $MucGiam= $re->MucGiam;

        $coupon = array();
        $coupon['TenMa']      =$re->TenMa;
        $coupon['LoaiGiamGia']=$re->LoaiGiamGia;
        if ($option==0) {
            $coupon['MucGiam']    =$MucGiam;
        }else{
            $coupon['MucGiam']    =$MucGiam/100;
        }
        $coupon['SoLuong']    =$re->SoLuong;
        $coupon['Code']       =$re->Code;
        $coupon['TG_BD']      =$re->TG_BD;
        $coupon['TG_KT']      =$re->TG_KT;
        $coupon['TinhTrang']  =$re->TinhTrang;

        $MaGiam = DB::table('magiamgia')->insertGetId($coupon);

        $coupon_detail=array();
        $data=$re->SP;
        if ($MaGiam!=Null) {
            foreach ($data as $key => $value) {
                if ($option==0) {  
                    //nhóm sp -> loaihanghoa
                    $result = DB::table('loaihanghoa')->where('MaLoaiHang',$value)->first();
                    $coupon_detail['MaGiam']     =$MaGiam;
                    $coupon_detail['MSHH']       =$value;
                    $coupon_detail['TenHH']      =$result->TenLoaiHang;
                    $coupon_detail['MucGiam']    =$MucGiam;
                    $coupon_detail['TG_Tao']     =$now;
                    $coupon_detail['TG_CapNhat'] =$now;
                    $re = DB::table('chitietgiamgia')->insert($coupon_detail);
                }else{
                    //từng sp -> hanghoa
                    $result = DB::table('hanghoa')->where('MSHH',$value)->first();
                    $coupon_detail['MaGiam']     =$MaGiam;
                    $coupon_detail['MSHH']       =$value;
                    $coupon_detail['TenHH']      =$result->TenHH;
                    $coupon_detail['MucGiam']    =$MucGiam/100;
                    $coupon_detail['TG_Tao']     =$now;
                    $coupon_detail['TG_CapNhat'] =$now;
                    $re = DB::table('chitietgiamgia')->insert($coupon_detail);
                }
            }
        }
        
        if ($re) {
            return Redirect::to('/show_discount');
        }else{
            return redirect('/add_coupon')->with('notice','Thanh Toán Thất Bại');
        }
        
    }    
}
