<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CateChildController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function catechild_management(){
        $this->AuthLogin();
        Session::put('page',10);
    	$category_child = DB::table('danhmuc')->join('loaihanghoa', 'loaihanghoa.MaLoaiHang', '=', 'danhmuc.MaLoaiHang')->get();
    	return view('admin.CateChild.catechild_management', compact('category_child'));
    }

    public function add(){
    	$this->AuthLogin();
    	$all_category = Category::all();
    	return view('admin.CateChild.add_catechild', compact('all_category'));
    }

    public function save_catechild(Request $re){
    	$this->AuthLogin();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

        $data = array();
        $data['MaLoaiHang']= $re->MaLoaiHang;
        $data['TenDanhMuc'] = $re->TenDanhMuc;
        $data['created_at'] = $now;
    	$data['updated_at'] = $now;
    	DB::table('danhmuc')->insert($data);
    	return Redirect::to('catechild_management');
    }

    public function update_catechild($id){
    	$this->AuthLogin();
    	$all_category = Category::all();
        $update_category = DB::table('danhmuc')->where('MaDM',$id)->get();
        $manager_category_product  = view('admin.CateChild.update_catechild')->with('edit_category_child',$update_category)->with('category', $all_category);

        return view('admin_layout')->with('admin.edit_category_child', $manager_category_product)
        ;
    }

    public function edit_catechild(Request $re, $id){
    	$this->AuthLogin();

    	$now = Carbon::now('Asia/Ho_Chi_Minh');

        $data = array();
        $data['MaLoaiHang']= $re->MaLoai;
        $data['TenDanhMuc'] = $re->TenDanhMuc;
        $data['created_at'] = $now;
    	$data['updated_at'] = $now;
    	DB::table('danhmuc')->where('MaDM', $id)->update($data);
    	return Redirect::to('catechild_management');
    }

}
