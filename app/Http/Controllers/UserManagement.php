<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;
use Session;
session_start();

class UserManagement extends Controller
{
    //Admin
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //Kiểm tra đăng nhập trang user
    public function LoginCheck(){
        $MSKH=Session::get('user_id');
        if($MSKH){
            
        }else{
            return Redirect::to('login_home')->send();
        }
    }
    public function user(){
        $this->AuthLogin();
    	$id = Session::get('admin_id');
    	$infor = DB::table('nhanvien')->where('MSNV',$id)->get();
    	$manage_infor = view('admin.User.user')->with('staff_infor',$infor);
    	return view('admin_layout')->with('admin.User.user',$manage_infor);
    	// return view('admin.update_user');
    }

    public function update_user(Request $re){
        $this->AuthLogin();
    	$data = array();
    	$id = Session::get('admin_id');
    	$data['HoTenNV'] = $re->HoTen;
    	$data['GioiTinh'] = $re->GioiTinh;
    	$data['Email'] = $re->Email;
    	$data['DiaChi'] = $re->DiaChi;
    	$data['SDT'] = $re->SDT;
    	$data['Ngay'] = $re->Ngay;
    	$data['Thang'] = $re->Thang;
    	$data['Nam'] = $re->Nam;

        $get_image = $re->file('Avatar');

        if($get_image){
            $get_name = $get_image->getClientOriginalName();
            $name = current(explode('.', $get_name));
            $new_image = $name.time() .'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/backend/images/avatar',$new_image);
            $data['Avatar']=$new_image;
            DB::table('nhanvien')->where('MSNV',$id)->update($data);
            return Redirect::to('/user');
        }

        DB::table('nhanvien')->where('MSNV',$id)->update($data);
        return Redirect::to('/user');
    }

    public function password(){
        return view('admin.User.password');
    }

    public function change_pass(Request $re){
        $id = Session::get('admin_id');
        $TaiKhoan= $re->TaiKhoan;
        $MatKhau = $re->MatKhau;

        $result = DB::table("nhanvien")->where('MSNV',$id)->first();

        if($result->TaiKhoan==$TaiKhoan){
            DB::table('nhanvien')->where('MSNV',$id)->update(['MatKhau'=>md5($MatKhau)]);
            echo 1;
        }else{
            echo 0;
        }
    }

    //User interface
    public function user_register(Request $re){
        //Seo
        $meta_desc="Trang đăng ký";
        $meta_keywords="Register";
        $meta_tittle="Đăng Ký";
        $url=$re->url();
        // end seo
        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
        $all_cate = DB::table('danhmuc')->get();

        return view('pages.user.register')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)->with('cate',$all_cate);
    }

    public function user_login(Request $re){
        //Seo
        $meta_desc="Trang đăng nhập";
        $meta_keywords="Login";
        $meta_tittle="Đăng Nhập";
        $url=$re->url();
        // end seo

        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
        $all_cate = DB::table('danhmuc')->get();

        return view('pages.user.login_home')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)->with('cate',$all_cate);
    }

    public function login(Request $request){
        $TaiKhoan=$request->TaiKhoan;
        $MatKhau=md5($request->MatKhau);
        $result = DB::table('khachhang')->where('TaiKhoan',$TaiKhoan)->where('MatKhau',$MatKhau)->first();
        if ($result) {
            Session::put('user_name',$result->TaiKhoan);
            Session::put('user_id',$result->MSKH);
            return redirect('/trang_chu');
        }else{
            return redirect('/login_home')->with('notice','Mật khẩu hoặc tài khoản không đúng');
        }
    }

    public function quick_login(Request $request){
        $TaiKhoan=$request->TaiKhoan;
        $MatKhau=md5($request->MatKhau);
        $result = DB::table('khachhang')->where('TaiKhoan',$TaiKhoan)->where('MatKhau',$MatKhau)->first();
        if ($result) {
            Session::put('user_name',$result->TaiKhoan);
            Session::put('user_id',$result->MSKH);
            return redirect('/check_out');
        }else{
            return redirect('/check_out')->with('notice','Mật khẩu hoặc tài khoản không đúng');
        }
    }

    public function register(Request $request){
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $mk=$request->MatKhau;
        $mk1=$request->MatKhau1;
        // $data['MatKhau']
        $check=$request->Check;
        if(checkdate($request->Thang, $request->Ngay, $request->Nam) && $check==1 && ($mk==$mk1)){
            
            $data['HoTenKH'] = $request->HoTenKH;
            $data['GioiTinh'] = $request->GioiTinh;
            $data['Email'] = $request->Email;
            $data['SoDienThoai'] = $request->SDT;
            $data['Ngay'] = $request->Ngay;
            $data['Thang'] = $request->Thang;
            $data['Nam'] = $request->Nam;
            $data['TaiKhoan']=$request->TaiKhoan;
            $data['MatKhau']=md5($request->MatKhau);
            $data['HoatDong']=1;
            $data['TG_Tao'] = $now;
            $data['TG_CapNhat'] = $now;
            DB::table('khachhang')->insert($data);
            return Redirect::to('/login_home');
        }
    }

    public function user_logout(){
        Session::put('user_name',null);
        Session::put('user_id',null);
        Session::put('cart',null);
        return redirect('/trang_chu');
    }

    //Account user
    public function my_account(Request $re){
        $this->LoginCheck();
        $MSKH=Session::get('user_id');
        //Seo
        $meta_desc="Quản lý tài khoản cá nhân";
        $meta_keywords="My Account";
        $meta_tittle="HPStore";
        $url=$re->url();
        // end seo
        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
        $all_cate = DB::table('danhmuc')->get();
        //Thông tin cá nhân
        $user_infor= DB::table('khachhang')->where('MSKH', $MSKH)->get();
        //Danh sách địa chỉ nhận hàng
        $address_ship = DB::table('diachikh')->where('MSKH', $MSKH)->get();

        return view('pages.user.my_account')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('user_infor',$user_infor)->with('address_ship',$address_ship)
        ->with('meta_desc',$meta_desc)->with('url',$url)->with('cate',$all_cate)
        ->with('meta_keywords',$meta_keywords)->with('meta_tittle',$meta_tittle);
    }

    public function change_password(Request $request){
        $this->LoginCheck();
        $MSKH=Session::get('user_id');
        $Username=$request->username;
        $New_pass=md5($request->new_pwd);
        $Confirm_pass=md5($request->confirm_pwd);

        $result= DB::table('khachhang')->where('MSKH',$MSKH)->first();
        if ($result->TaiKhoan==$Username) {
            DB::table('khachhang')->where('MSKH',$MSKH)->update(['MatKhau'=>$New_pass]);
            return Redirect::to('/my_account');
        }else{
            return redirect('/my_account')->with('notice','Tài khoản không đúng');
        }
    }

    public function change_info(Request $request){
        $this->LoginCheck();
        $data = array();
        $MSKH=Session::get('user_id');
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        if(checkdate($request->Thang, $request->Ngay, $request->Nam)){
            
            $HoTenKH = $request->HoTenKH;
            $GioiTinh = $request->GioiTinh;
            $Email = $request->Email;
            $SoDienThoai = $request->SDT;
            $Ngay = $request->Ngay;
            $Thang = $request->Thang;
            $Nam = $request->Nam;
            DB::table('khachhang')->where('MSKH',$MSKH)->update([
                'HoTenKH' => $HoTenKH, 
                'GioiTinh' => $GioiTinh,
                'Email' => $Email, 
                'Ngay' =>$Ngay,
                'Thang' =>$Thang,
                'Nam'=>$Nam,
                'SoDienThoai'=>$SoDienThoai,
                'TG_CapNhat' =>$now
            ]);
            return Redirect::to('/my_account');
        }
    }

    public function show_address(Request $re){
        $this->LoginCheck();
        $MaDC = $re->MaDC;
        $result= DB::table('diachikh')->where('MaDC',$MaDC)->get();
        $output=array();
        foreach ($result as $key => $value) {
            $output['HoTen']='<input type="text" name="HoTen" placeholder="Họ và tên" value="'.$value->HoTen.'" />';
            $output['SDT']='<input type="text" name="SDT" placeholder="Số điện thoại" required value="'.$value->SDT.'" />';
            $output['DiaChi']='<input type="text" name="DiaChi" placeholder="Địa chỉ cụ thế" required value="'.$value->DiaChi.'"/>';
            $output['MaDC']='<input type="hidden" name="MaDC" value="'.$MaDC.'">';
        }
        echo json_encode($output);
    }

    public function update_address(Request $re){
        $this->LoginCheck();
        $data=array();

        $MaDC=$re->MaDC;
        $HoTen=$re->HoTen;
        $SDT=$re->SDT;
        $DiaChi=$re->DiaChi;

        DB::table('diachikh')->where('MaDC',$MaDC)->update([
            'HoTen' =>$HoTen, 
            'SDT'   =>$SDT,
            'DiaChi'=>$DiaChi
        ]);
        return Redirect::to('/my_account');
    }
}
