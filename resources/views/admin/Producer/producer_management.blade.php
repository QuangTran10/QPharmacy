@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <a href="{{URL::to('/add_producer')}}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Thêm NSX
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách Nhà Sản Xuất</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th>Mã NSX</th>
              <th>Tên Nhà Sản Xuất</th>
              <th style="text-align: center;">Tình Trạng</th>
              <th>Thời Gian Cập Nhật</th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              @foreach($all_producer as $key => $value)
              <tr>
                <td>{{$value->MaNSX}}</td>
                <td>{{$value->TenNSX}}</td>
                <td style="text-align: center;">
                  <?php
                    if($value->TinhTrang ==1)
                      echo '<i class="material-icons">done</i>';
                    else  
                      echo '<i class="material-icons">clear</i>';
                  ?>
                </td>
                <td>{{$value->TG_CapNhat}}</td>
                <td>
                  <a href="{{URL::to('/update_producer/'.$value->MaNSX)}}"><i class="material-icons">edit</i></a>
                </td>
                <td>
                  <a href="{{URL::to('/delete_producer/'.$value->MaNSX)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá')">
                    <i class="material-icons">delete</i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
