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

    //Thêm coupon
    public function save_coupon(Request $re){
        $coupon = array();
        $coupon['TenMa']=$re->TenMa;
        $coupon['LoaiGiamGia']=$re->LoaiGiamGia;
        $coupon['MucGiam']=$re->MucGiam/100;
        $coupon['SoLuong']=$re->SoLuong;
        $coupon['Code']=$re->Code;
        $coupon['TG_BD']=$re->TG_BD;
        $coupon['TG_KT']=$re->TG_KT;
        $coupon['TinhTrang']=$re->TinhTrang;
        
        DB::table('magiamgia')->insert($coupon);
        return Redirect::to('/show_discount');
    }    
}
