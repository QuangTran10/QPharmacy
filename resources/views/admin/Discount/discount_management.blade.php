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
          <div class="row">
            
          </div>
        </div> {{-- end card body --}}
      </div>
    </div>
  </div>
</div>
@endsection
