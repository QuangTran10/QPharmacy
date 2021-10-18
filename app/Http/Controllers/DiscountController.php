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
    	return view('admin.Discount.discount_management');
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
        $data = $re->all();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
