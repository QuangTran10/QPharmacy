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
          <h4 class="card-title"></h4>
        </div>
        <div class="card-body table-responsive">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <label class="col-sm-2 col-form-label">Áp dụng cho</label>
                <div class="col-sm-10">
                  <form>
                    @csrf
                    <div class="form-group">
                      <select class="form-control choose_option" >
                        <option>Chọn</option>
                        <option value="0">Nhóm sản phẩm</option>
                        <option value="1">Từng sản phẩm</option>
                      </select>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <label class="col-sm-2 col-form-label">Lựa Chọn</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <select class="form-control" data-style="btn btn-link" id="show_option"></select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> {{-- end card body --}}
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.choose_option').on('change', function(){  
      var option = $(this).val();
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: '{{url('/select_option_discount')}}',
        method: "POST",
        data:{
          option:option,
          _token:_token},
          success:function(data){
            $('#show_option').html(data);
          }
        });
    });
  });
</script>

@endsection
