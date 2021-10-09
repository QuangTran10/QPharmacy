<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
session_start();

class RevenueController extends Controller
{
    public function show_statistical(){
    	Session::put('page',10);
    	return view('admin.Statistic.show_statistic');
    }

    public function load_statistic(){
    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$first_day=Carbon::create(Carbon::now()->year, 1, 1);

    	$revenue = DB::table('dathang')
    	->whereBetween('NgayDH', [ $first_day, $now])
    	->select(DB::raw('COUNT(SoDonDH) as soluong, MONTH(NgayDH) as Thang'))->groupBy('Thang')
    	->get();

    	$labels=array();
    	$series=array();
    	foreach ($revenue as $key => $value) {
    		$labels[]=$value->Thang;
    		$series[]=$value->soluong;
    	}
    	$chart_data = array(
    		'labels' => $labels,
    		'series' => $series
    	);

    	echo $data = json_encode($chart_data);
    }
}
