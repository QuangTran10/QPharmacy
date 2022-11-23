@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">CẬP NHẬT NHÀ SẢN XUẤT</h4>
          </div>
        </div>
        <div class="card-body ">
          <form action="{{url('/edit_suppliers')}}" method="post" class="form-horizontal">
            {{csrf_field() }}
            <div class="row">
              <label class="col-sm-3 col-form-label">Tên Nhà Cung Cấp</label>
              <div class="col-sm-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="TenNCC" required value="{{$supplier->TenNCC}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-3 col-form-label">Địa Chỉ</label>
              <div class="col-sm-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="DiaChi" required value="{{$supplier->DiaChi}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-3 col-form-label">Số Điện Thoại</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="SDT" required value="{{$supplier->SDT}}">
              </div>
            </div>
            <input type="hidden" name="MaNCC" value="{{$supplier->MaNCC}}">
            <a href="{{url('/suppliers')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="update">Cập Nhật</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
