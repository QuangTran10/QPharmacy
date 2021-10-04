<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CategoryManagement extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function category_management(){
        $this->AuthLogin();
        Session::put('page',4);
    	$all_category = Category::simplePaginate(5);
    	$manage_category = view('admin.Category.category_management')->with('all_category',$all_category);
    	return view('admin_layout')->with('admin.Category.category_management',$manage_category);
    }

    //Chuyển trang thêm danh mục
    public function add(){
        $this->AuthLogin();
    	return view('admin.Category.add_category');
    }

    //Hàm thêm danh mục
    public function save_category(Request $re){
        $this->AuthLogin();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

        $data = $re->all();
        $cate = new Category();
        $cate->TenLoaiHang= $data['TenLoaiHang'];
        $cate->TinhTrang= $data['TinhTrang'];
        $cate->save();
    	return Redirect::to('category_management');
    }

    //Chuyển trang cập nhật danh mục
    public function update_category($category_product_id){
        $this->AuthLogin();
        $update_category = Category::find($category_product_id);
        $manager_category_product  = view('admin.Category.update_category')->with('edit_category_product',$update_category);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    //Hàm Cập nhật danh mục
    public function edit_category(Request $re, $category_product_id){
        $this->AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data = $re->all();
        $cate = Category::find($category_product_id);
        $cate->TenLoaiHang= $data['TenLoaiHang'];
        $cate->TinhTrang= $data['TinhTrang'];
        $cate->save();

        return Redirect::to('category_management');
    }

    //Chuyển trang xoá danh mục
    public function delete($category_product_id){
        $this->AuthLogin();
        $del_cate= Producer::find($category_product_id);
        $del_cate->delete();
    	// DB::table('loaihanghoa')->where('MaLoaiHang',$category_product_id)->delete();
        return Redirect::to('category_management');
    }

    //END ADMIN 

    //USER INTERFACE
    public function show_category_home($id_cate, Request $re){
        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();

        $category_by_id =DB::table('hanghoa')->where('hanghoa.MaLoaiHang',$id_cate)
        ->join('loaihanghoa', 'hanghoa.MaLoaiHang', '=', 'loaihanghoa.MaLoaiHang')
        ->simplePaginate(3);

        $category=DB::table('loaihanghoa')->where('MaLoaiHang',$id_cate)->get();

        foreach ($category as $key => $value) {
            //Seo
            $meta_desc=$value->TenLoaiHang;
            $meta_keywords="Category - ". $value->MaLoaiHang;
            $meta_tittle="QPharmacy";
            $url=$re->url();
            // end seo
        }
        $count_category_by_id=DB::table('hanghoa')->where('MaLoaiHang',$id_cate)->get()->count();
        return view('pages.category.show_category')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('product',$category_by_id)->with('soluong',$count_category_by_id)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url);
    }
}
