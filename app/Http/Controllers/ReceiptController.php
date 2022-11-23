<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
use PDF;
session_start();

class ReceiptController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
	//Danh sách
    public function show_all(){
        $this->AuthLogin();
        $all= DB::table('phieunhap')
        ->join('nhanvien', 'nhanvien.MSNV','=','phieunhap.MSNV')
        ->join('nhacungcap','nhacungcap.MaNCC','=','phieunhap.MaNCC')
        ->select('phieunhap.*','HoTenNV','TenNCC')->get();
        Session::put('page',7);
        return view('admin.Receipt.receipt_all')->with('all_receipt', $all);
    }

    //Thêm phiếu nhập
    public function show_add(){
        $this->AuthLogin();

        $product=DB::table('hanghoa')->get();

        $supplier = DB::table('nhacungcap')->get();

        return view('admin.Receipt.add_receipt', compact('product','supplier'));
    }

  //add
    public function add(Request $re){
        $this->AuthLogin();
        $data= $re->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        $total =0;
        for ($i=0; $i < $data['index']; $i++) { 
          $total += $data['Quantity'][$i]*$data['Price'][$i];
      }

    //Receipt
      $receipt=array();

      $receipt['MSNV']=Session::get('admin_id');
      $receipt['ThanhTien']=$total;
      $receipt['NgayLap']=$now;
      $receipt['MaNCC']=$re->MaNCC;
      $receipt['GhiChu']=$re->GhiChu;
      $receipt['TinhTrang']=$re->TinhTrang;
      $receipt['created_at']=$now;
      $receipt['updated_at']=$now;

      $MaPhieu=DB::table('phieunhap')->insertGetId($receipt);

      $ds= array();
      for ($i=0; $i < $data['index']; $i++) { 
          $ds['MaPhieu']= $MaPhieu;
          $ds['MSHH'] = $data['Product'][$i];
          $ds['SoLuong'] = $data['Quantity'][$i];
          $ds['DonGia'] = $data['Price'][$i];
          $ds['created_at']=$now;
          $ds['updated_at']=$now;

          $result=DB::table('chitietphieunhap')->insert($ds);
          if ($result) {
             $kq=1;
         }
     }

     if ($kq==1) {
        return Redirect::to('show_receipt');
    }else{
        Session::put('message','Thêm Thất bại');
        return Redirect::to('add_receipt');
    }

}

public function show(Request $request){

  $receipt = DB::table('phieunhap')
  ->join('nhanvien', 'nhanvien.MSNV', '=', 'phieunhap.MSNV')
  ->join('nhacungcap', 'nhacungcap.MaNCC', '=', 'phieunhap.MaNCC')
  ->where('MaPhieu', $request->MaPhieu)->select('phieunhap.*', 'nhacungcap.TenNCC', 'nhanvien.HoTenNV')->first();

  $detail_receipt = DB::table('chitietphieunhap')
  ->join('hanghoa', 'hanghoa.MSHH', '=', 'chitietphieunhap.MSHH')
  ->select('chitietphieunhap.*', 'hanghoa.TenHH')
  ->where('MaPhieu', $request->MaPhieu)->get();

  $url = '/print_receipt/'.$request->MaPhieu;

  $output = '
  <h4 style="text-align: center; padding-bottom: 15px"><b>CHI TIẾT PHIẾU NHẬP HÀNG</b></h4>
  <div class="instruction">
  <div class="row">
  <div class="col-md-3">
  <b>Mã:</b> '.$receipt->MaPhieu.'
  </div>
  </div>
  <div class="row">
  <div class="col-md-6">
  <b>Người nhập hàng:</b> '.$receipt->HoTenNV.'
  </div>
  </div>
  <div class="row">
  <div class="col-md-6">
  <b>Ngày nhập hàng:</b> '.$receipt->NgayLap.'
  </div>
  </div>
  <div class="row">
  <div class="col-md-12">
  <b>Nhà cung cấp:</b> '.$receipt->TenNCC.'
  </div>
  </div>
  <div class="row">
  <div class="col-md-12">
  <b>Số sản phẩm:</b> '.count($detail_receipt).'
  </div>
  </div>
  <div class="instruction">
  <div class="row">
  <div class="table-responsive">
  <table class="table">
  <thead class=" text-primary">
  <th>STT</th>
  <th width="40%">Tên sản phẩm</th>
  <th>Số lượng</th>
  <th>Đơn giá</th>
  <th>Tổng</th>
  </thead>
  <tbody>
  ';
  $i = 1;
  foreach ($detail_receipt as $key => $value) {
    $output .= '
    <tr>
    <td>'.$i.'</td>
    <td>'.$value->TenHH.'</td>
    <td>'.$value->SoLuong.'</td>
    <td>'.number_format($value->DonGia , 0, ',', ' ').'đ </td>
    <td>'.number_format($value->DonGia*$value->SoLuong , 0, ',', ' ').'đ</td>
    </tr>';
    $i++;
}

$output .='
<tr>
<td colspan="2"></td>
<td colspan="2"><b>Tổng giá trị nhập hàng</b></td>
<td>'.number_format($receipt->ThanhTien , 0, ',', ' ').'đ</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<div class="modal-footer justify-content-center">
<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Thoát</button>
<a href="'.url($url).'" class="btn btn-success btn-round" target="_blank"><i class="material-icons">print</i> In Phiếu</a>
</div>
';


echo $output; 
}

//In phiếu nhập hàng
public function print($code){
  $this->AuthLogin();
  $now = Carbon::now('Asia/Ho_Chi_Minh');
  $data=array();

  $contact = DB::table('lienhe')->get();

  $receipt = DB::table('phieunhap')
  ->join('nhanvien', 'nhanvien.MSNV', '=', 'phieunhap.MSNV')
  ->join('nhacungcap', 'nhacungcap.MaNCC', '=', 'phieunhap.MaNCC')
  ->where('MaPhieu', $code)->select('phieunhap.*', 'nhacungcap.TenNCC', 'nhanvien.HoTenNV')->first();

  $detail_receipt = DB::table('chitietphieunhap')
  ->join('hanghoa', 'hanghoa.MSHH', '=', 'chitietphieunhap.MSHH')
  ->select('chitietphieunhap.*', 'hanghoa.TenHH')
  ->where('MaPhieu', $code)->get();

  $data['contact']=$contact;
  $data['URL']='public/frontend/assets/img/logo_brand.png';
  $data['receipt']=$receipt;
  $data['receipt_details']=$detail_receipt;

  $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.Receipt.invoice', $data);
  $name="Receipt_".$code."_".$now->day.$now->month.$now->year.".pdf";
  return $pdf->stream($name);
}
}
