<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\URL;
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

        $bestsell = DB::table('chitietdathang')
        ->select(DB::raw('COUNT(MSHH) as sl', 'MSHH'),'MSHH')->groupBy('MSHH')->orderBy('sl','Desc')
        ->limit(6)->get();
        $pro_best_seller=array();
        foreach ($bestsell as $key => $value) {
            $pro_best_seller[]=DB::table('hanghoa')->where('MSHH',$value->MSHH)->first();
        }
        
    	return view('pages.home')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('pro_best_seller',$pro_best_seller);
    }

    public function search(Request $re){
    	$key_words=$_GET['key_words'];
        //Seo
        $meta_desc="Tìm kiếm";
        $meta_keywords=$key_words;
        $meta_tittle="QPharmacy";
        $url=url()->current();
        // end seo

        if (isset($_GET['sort_by'])) {

            $sort_by= $_GET['sort_by'];

            if($sort_by=='az'){

               $product_search=DB::table('hanghoa')->where('TenHH','like','%'.$key_words.'%')
                ->orderBy('TenHH','ASC')->get();

            }elseif ($sort_by=='za') {

                $product_search=DB::table('hanghoa')->where('TenHH','like','%'.$key_words.'%')
                ->orderBy('TenHH','DESC')->get();

            }elseif ($sort_by=='increase') {

                $product_search=DB::table('hanghoa')->where('TenHH','like','%'.$key_words.'%')
                ->orderBy('Gia','ASC')->get();

            }elseif ($sort_by=='decrease') {

                $product_search=DB::table('hanghoa')->where('TenHH','like','%'.$key_words.'%')
                ->orderBy('Gia','DESC')->get();
                
            }
        }else{
            $product_search=DB::table('hanghoa')->where('TenHH','like','%'.$key_words.'%')
            ->orderBy('MSHH','ASC')
            ->get();
        }    
    	
    	$all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
    	return view('pages.category.product_search')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('product_search',$product_search)->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)->with('meta_tittle',$meta_tittle)
        ->with('url',$url);
    }
}
