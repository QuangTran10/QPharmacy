@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Thống kê doanh thu</h4>
        </div>
        <div class="card-body table-responsive">
          <form>
            @csrf
            <div class="ct-chart ct-golden-section" id="chart1"></div>
          </form>
        </div> {{-- end card body --}}
      </div>
    </div>
  </div>
</div>

@endsection
