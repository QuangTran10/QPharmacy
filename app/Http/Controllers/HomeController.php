<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;

class HomeController extends Controller
{
    public function index(Request $re){
        //Seo
        $meta_desc="QPharmacy Nhà Thuốc Online";
        $meta_keywords="Trang Chủ";
        $meta_tittle="QPharmacy";
        $url=$re->url();
        // end seo

    	$all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
    	return view('pages.home')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url);
    }

    public function search(Request $re){
    	$key_words=$re->key_words;
        //Seo
        $meta_desc="Tìm kiếm";
        $meta_keywords=$key_words;
        $meta_tittle="QPharmacy";
        $url=$re->url();
        // end seo

    	$product_search=DB::table('hanghoa')->where('TenHH','like','%'.$key_words.'%')->get();
    	$all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
    	return view('pages.category.product_search')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('product_search',$product_search)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_tittle',$meta_tittle)
        ->with('url',$url);
    }
}
