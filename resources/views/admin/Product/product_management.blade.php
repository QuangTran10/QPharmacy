@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <a href="{{URL::to('/add_product')}}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Thêm Sản Phẩm
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách sản phẩm</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th width="15%">Tên Sản Phẩm</th>
              <th width="10%">Giá</th>
              <th width="10%">Số Lượng</th>
              <th width="10%">Loại Hàng</th>
              <th width="15%">Nhà Sản Xuất</th>
              <th style="text-align: center;" width="10%">Tình Trạng</th>
              <th width="10%">Hình Ảnh</th>
              <th width="5%"></th>
              <th width="5%"></th>
            </thead>
            <tbody>
              @foreach($all_product as $key => $value)
              <tr>
                <td>{{$value->TenHH}}</td>
                <td>{{number_format($value->Gia , 0, ',', ' ').'đ';}}</td>
                <td>{{$value->SoLuongHang}}</td>
                <td>{{$value->TenLoaiHang}}</td>
                <td>{{$value->TenNSX}}</td>
                <td style="text-align: center;">
                  <?php
                    if($value->TrangThai ==1)
                      echo '<i class="material-icons">done</i>';
                    else  
                      echo '<i class="material-icons">clear</i>';
                  ?>
                </td>
                <td><img src="public/upload/{{$value->hinhanh1}}" width="100"></td>
                <td>
                  <a href="{{URL::to('/update_product/'.$value->MSHH)}}"><i class="material-icons">edit</i></a>
                </td>
                <td>
                  <a href="{{URL::to('/delete_product/'.$value->MSHH.'/'.$value->hinhanh1)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá')">
                    <i class="material-icons">delete</i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div style="text-align: center;">
            {{$all_product->links()}}
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
