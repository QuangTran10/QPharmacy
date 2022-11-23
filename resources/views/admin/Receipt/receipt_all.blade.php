@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <a href="{{URL::to('/add_receipt')}}" class="btn btn-primary" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Thêm Phiếu Nhập
      </a>
      <a href="{{URL::to('/suppliers')}}" class="btn btn-warning" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Quản lý nhà cung cấp
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách phiếu nhập</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th width="10%">Mã Phiếu</th>
              <th width="15%">Người Lập</th>
              <th width="15%">Thành Tiền</th>
              <th width="15%">Ngày Lập</th>
              <th width="20%">Nhà Cung Cấp</th>
              <th style="text-align: center;" width="20%">Tình Trạng</th>
              <th width="10%"></th>
            </thead>
            <tbody>
              @foreach($all_receipt as $key => $value)
              <tr>
                <td>{{$value->MaPhieu}}</td>
                <td>{{$value->HoTenNV}}</td>
                <td>{{number_format($value->ThanhTien , 0, ',', ' ').'đ';}}</td>
                <td>{{$value->NgayLap}}</td>
                <td>{{$value->TenNCC}}</td>
                <td style="text-align: center;">
                  <?php
                    if($value->TinhTrang ==0)
                      echo 'Chưa Thanh Toán';
                    else  
                      echo 'Đã Thanh Toán';
                  ?>
                </td>
                <td>
                  <form>
                    {{csrf_field() }}
                  </form>
                  <button type="button" rel="tooltip" class="btn btn-info information" data-id="{{$value->MaPhieu}}" ><i class="material-icons">info</i></button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div style="text-align: center;">

          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="infor-receipt" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-left">HoangPhuc Store</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">close</i>
        </button>
      </div>
      <div class="modal-body" id="modalReceipt">
        <h4 style="text-align: center; padding-bottom: 15px"><b>CHI TIẾT PHIẾU NHẬP HÀNG</b></h4>
        <div class="instruction">
          <div class="row">
            <div class="col-md-3">
              <b>Mã:</b> 1
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <b>Người nhập hàng:</b> Nguyễn Văn Entony
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <b>Ngày nhập hàng:</b> Nguyễn Văn Entony
            </div>
          </div>
          <div class="instruction">
            <div class="row">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Thoát</button>
          </div>
        </div>
      </div>
    </div>
  </div>  
    <!-- end notice modal -->

@endsection
