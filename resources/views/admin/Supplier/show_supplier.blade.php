@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <button class="btn btn-primary" role="button" aria-disabled="true" data-toggle="modal" data-target="#add_producer">
         <i class="material-icons">edit</i> Thêm
      </button>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách NSX</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th width="10%">Mã</th>
              <th width="25%">Tên</th>
              <th width="35%">Địa Chỉ</th>
              <th width="20%">Số Điện Thoại</th>
              <th width="5%"></th>
            </thead>
            <tbody>
              @foreach($suppliers as $key => $value)
              <tr>
                <td><b>{{$value->MaNCC}}</b></td>
                <td>{{$value->TenNCC}}</td>
                <td>{{$value->DiaChi}}</td>
                <td>{{$value->SDT}}</td>
                <td class="td-actions">
                  <a href="{{URL::to('/update_suppliers/'.$value->MaNCC)}}" rel="tooltip" class="btn btn-info btn-link">
                    <i class="material-icons">edit</i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="row">
            <div class="col-md-4">
              <a href="{{URL::to('/show_receipt')}}" class="btn btn-primary">Trở Về</a>
            </div>
            <div class="col-md-4">
              {{-- {{$producer->links('partials.admin_paginate')}} --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_producer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Thêm Nhà Cung Cấp</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form action="{{URL::to('/add_suppliers')}}" method="post" class="form-horizontal" >
        {{csrf_field() }}
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-3 col-form-label">Tên NCC</label>
            <div class="col-sm-9">
              <div class="form-group">
                <input type="text" class="form-control" name="TenNCC" required>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-3 col-form-label">Địa Chỉ</label>
            <div class="col-sm-9">
              <div class="form-group">
                <input type="text" class="form-control" name="DiaChi" required>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-3 col-form-label">Số Điện Thoại</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="SDT" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-link">Thêm</button>
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection
