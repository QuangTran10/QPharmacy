<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
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
    public function error_page(){
        return view('errors.404');
    }
    public function index(){
    	return view('admin_login');
    }

    public function dashboard(){
        $this->AuthLogin();
        Session::put('page',1);
        //Số người đăng ký
        $subscribers = DB::table('khachhang')->get()->count();
        //Doanh thu
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $first_date=Carbon::create(Carbon::now()->year, 1, 1);

        $array = DB::table('dathang')->whereBetween('NgayDH',[ $first_date, $now])->select('ThanhTien')->get();
        $statistic =0;
        foreach ($array as $key => $value) {
            $statistic += $value->ThanhTien;
        }
        //Tổng số sản phẩm
        $products = DB::table('hanghoa')->get()->count();
    	return view('admin.dashboard')->with('subscribers',$subscribers)
        ->with('products',$products)->with('statistical',$statistic);
    }
    public function admin_dashboard(Request $request){
    	$username = $request->Username;
    	$password = md5($request->Password);

    	$result = DB::table('nhanvien')->where('TaiKhoan',$username)->where('MatKhau',$password)->first();
        //Số người đăng ký
        $subscribers = DB::table('khachhang')->get()->count();
        //Doanh thu
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $first_date=Carbon::create(Carbon::now()->year, 1, 1);

        $array = DB::table('dathang')->whereBetween('NgayDH',[ $first_date, $now])->select('ThanhTien')->get();
        $statistic =0;
        foreach ($array as $key => $value) {
            $statistic += $value->ThanhTien;
        }
        //Tổng số sản phẩm
        $products = DB::table('hanghoa')->get()->count();

    	if ($result) {
            if ($result->HoatDong!=0) {
                Session::put('page',1);
                Session::put('admin_name',$result->TaiKhoan);
                Session::put('admin_id',$result->MSNV);
                Session::put('full_name',$result->HoTenNV);
                if($result->ChucVu=='Admin'){
                    Session::put('Position',1);
                }elseif ($result->ChucVu=='Kế Toán') {
                    Session::put('Position',2);
                }else{
                    Session::put('Position',0);
                }
                return view('admin.dashboard')->with('subscribers',$subscribers)->with('products',$products)->with('statistical',$statistic);
            }else{
                return redirect('/admin')->with('notice','Tài khoản đã bị khoá');
            }
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
