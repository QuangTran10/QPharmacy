@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <a href="{{URL::to('/add_coupon')}}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Thêm Mã Giảm Giá
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title"></h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th>Mã Khuyến Mãi</th>
              <th>Tên Khuyến Mãi</th>
              <th>Mức Giảm</th>
              <th style="text-align: center;">Tình Trạng</th>
              <th>Thời Gian Bắt Đầu</th>
              <th>Thời Gian Kết Thúc</th>
              <th>Thời Hạn</th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              @foreach($coupon as $key => $value)
              <tr>
                <td>{{$value->Code}}</td>
                <td>{{$value->TenMa}}</td>
                <td>{{$value->MucGiam*100}}%</td>
                <td style="text-align: center;">
                  <?php
                    if($value->TinhTrang ==1)
                      echo '<i class="material-icons">done</i>';
                    else  
                      echo '<i class="material-icons">clear</i>';
                  ?>
                </td>
                <td>
                  {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->TG_BD)->format('d/m/Y H:i:s')}}
                </td>
                <td>
                  {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->TG_KT)->format('d/m/Y H:i:s')}}
                </td>
                <td>
                  <?php
                    $date = (strtotime($value->TG_KT) - strtotime($value->TG_BD))/ (60*60*24);
                    echo 'Còn '.$date.' ngày';
                  ?>
                </td>
                <td>
                  <a href=""><i class="material-icons">edit</i></a>
                </td>
                <td>
                  <a href="" >
                    <i class="material-icons">delete</i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
           </table> 
        </div> {{-- end card body --}}
      </div>
    </div>
  </div>
</div>
@endsection
