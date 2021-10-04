@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12"></div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Bình Luận Chưa Duyệt</h4>
        </div>
        <div class="card-body">
          <table class="table">
            <tbody>
              @foreach($comment as $key => $value)
              <tr>
                <td>{{$value->TaiKhoan}}</td>
                <td>{{$value->NoiDung}}</td>
                <td>{{Carbon\Carbon::parse($value->ThoiGian)->format('d/m/Y')}}</td>
                <td><img src="public/upload/{{$value->hinhanh1}}" width="100"></td>
                <td>
                  <?php 
                    for ($i=1; $i <= $value->DanhGia ; $i++) { 
                      
                  ?>
                  <i class="material-icons" style="color: yellow">star</i>
                  <?php
                    }
                  ?>
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
