<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
session_start();

class SupplierController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function show(){
    	$this->AuthLogin();

    	$suppliers = DB::table('nhacungcap')->get();

    	return view('admin.Supplier.show_supplier', compact('suppliers'));
    }

    public function add(Request $request){
    	$this->AuthLogin();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

    	$data = $request->all();

    	$add = array();
    	$add['TenNCC'] = $data['TenNCC'];
    	$add['DiaChi'] = $data['DiaChi'];
    	$add['SDT']	   = $data['SDT'];
    	$add['created_at']=$now;
    	$add['updated_at']=$now;

    	$result = DB::table('nhacungcap')->insert($add);

    	return Redirect::to('/suppliers');

    }

    public function update($id){
    	$this->AuthLogin();

    	$supplier = DB::table('nhacungcap')->where('MaNCC',$id)->first();

    	return view('admin.Supplier.update_supplier', compact('supplier'));
    }

    public function edit(Request $request){
    	$this->AuthLogin();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');

    	$data = $request->all();

    	$result = DB::table('nhacungcap')->where('MaNCC', $data['MaNCC'])
    	->update([
    		'TenNCC' => $data['TenNCC'],
    		'DiaChi' => $data['DiaChi'],
    		'SDT'	 => $data['SDT'],
    		'updated_at'=> $now
    	]);

    	return Redirect::to('/suppliers');
    }
}
