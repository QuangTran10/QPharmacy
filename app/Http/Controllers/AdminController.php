<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
    	return view('admin_login');
    }

    public function dashboard(){
        $this->AuthLogin();
        //Số người đăng ký
        $subscribers = DB::table('khachhang')->get()->count();
        //Doanh thu

        //Tổng số sản phẩm
        $products = DB::table('hanghoa')->get()->count();
    	return view('admin.dashboard')->with('subscribers',$subscribers)->with('products',$products);
    }
    public function admin_dashboard(Request $request){
    	$username = $request->Username;
    	$password = md5($request->Password);

    	$result = DB::table('nhanvien')->where('TaiKhoan',$username)->where('MatKhau',$password)->first();
        //Số người đăng ký
        $subscribers = DB::table('khachhang')->get()->count();
        //Doanh thu

        //Tổng số sản phẩm
        $products = DB::table('hanghoa')->get()->count();

    	if ($result) {
            Session::put('page',1);
    		Session::put('admin_name',$result->TaiKhoan);
    		Session::put('admin_id',$result->MSNV);
            Session::put('full_name',$result->HoTenNV);
    		return view('admin.dashboard')->with('subscribers',$subscribers)->with('products',$products);
    	}else{
    		return redirect('/admin')->with('notice','Mật khẩu hoặc tài khoản không đúng');
    	}
    }
    public function Logout(){
        $this->AuthLogin();
    	Session::put('admin_name',null);
        Session::put('full_name',null);
    	Session::put('admin_id',null);
        Session::put('page',null);
    	return redirect('/admin');
    }
}