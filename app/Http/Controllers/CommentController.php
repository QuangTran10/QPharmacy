<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CommentController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //User interface
    public function load_comment(Request $re){
    	$MSHH = $re->id_product;
    	$comment_by_id= DB::table('binhluan')
    	->join('khachhang', 'khachhang.MSKH', '=', 'binhluan.MSKH')->where('MSHH',$MSHH)->where('TrangThai',1)->get();
    	$output='';
    	foreach ($comment_by_id as $key => $value) {
    		$output.='
    		<div class="total-reviews" >                                      
    		<div class="rev-avatar">
    		<img src=" '.url('public/frontend/assets/img/icon/avatar.jpeg').'" alt="">
    		</div>
    		<div class="review-box">
    		<div class="ratings"> ';
    		for ($i=1; $i <= $value->DanhGia; $i++) { 
    			$output.='<span class="good"><i class="fa fa-star"></i></span>';
    		}
    		$output.='
    		</div>
    		<div class="post-author">
    		<p>
    		<span>'.$value->TaiKhoan .'- '. Carbon::parse($value->ThoiGian)->format('d/m/Y').'</span> 
    		
    		</p>
    		</div>
    		<p>'.$value->NoiDung.'</p>
    		</div>
    		</div>
    		';
    		//
    	}

    	echo $output;
    }

    public function add_comment(Request $re){
    	$MSKH=Session::get('user_id');
    	$MSHH=$re->id_product;
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

    	$data=array();
    	$data['MSHH']=$MSHH;
    	$data['MSKH']=$MSKH;
    	$data['NoiDung']=$re->content;
    	$data['ThoiGian']=$now;
    	$data['DanhGia']=$re->rating;
    	$data['TrangThai']=0;

    	DB::table('binhluan')->insert($data);

    }


    //admin interface
    public function show_comment(){
        $this->AuthLogin();
        $comment_by_id= DB::table('binhluan')
        ->join('khachhang', 'khachhang.MSKH', '=', 'binhluan.MSKH')
        ->join('hanghoa', 'hanghoa.MSHH', '=', 'binhluan.MSHH')
        ->select('binhluan.*','TaiKhoan','hinhanh1')
        ->get();
        Session::put('page',8);
        return view('admin.Comment.show_comment')->with('comment',$comment_by_id);
    }

}
