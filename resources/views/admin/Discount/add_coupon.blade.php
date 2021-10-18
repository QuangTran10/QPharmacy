@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <form action="{{URL::to('/save_coupon')}}" method="post" id="add_coupon">
    @csrf 
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">THÊM MÃ GIẢM GIÁ</h4>
          </div>
          <div class="card-body">
            {{-- Tên chương trình KM --}} 
            <div class="form-group">
              <label>Tên Chương Trình</label>
              <input type="text" class="form-control" name="TenMa" id="TenMa">
            </div>

            {{-- Mã code --}}
            <div class="form-group">
                <label>Mã Giảm Giá</label>
                <input type="text" class="form-control" name="Code" id="Code">
            </div>

            {{-- Áp dụng cho nhóm sp và các sp --}} 
            <div class="row">
              <label class="col-sm-3 col-form-label">
                Loại Chương Trình
              </label>
              <div class="col-sm-9">
                <div class="form-group">
                  <select class="form-control choose_option selectpicker" data-style="btn btn-link" name="LoaiGiamGia" >
                    <option>Chọn</option>
                    <option value="0">Nhóm sản phẩm</option>
                    <option value="1">Từng sản phẩm</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-3 col-form-label">
                Lựa Chọn
              </label>
              <div class="col-sm-9">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" id="show_option" name="SP[]" multiple title="Chọn">
                    
                  </select>
                </div>
              </div>
            </div>

            {{-- Số lượng và tình trạng --}}
            <div class="row">
              <div class="col-md-7">
                <div class="row">
                  <label class="col-sm-4 col-form-label">
                    Tình Trạng
                  </label>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <select class="form-control selectpicker" data-style="btn btn-link" name="TinhTrang">
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="row">
                  <label class="col-sm-4 col-form-label">
                    Số Lượng Mã
                  </label>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <input type="number" class="form-control" name="SoLuong" min="1" id="SoLuong">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 col-form-label label-checkbox">Mức Giảm</label>
              <div class="col-sm-3 checkbox-radios" >
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="option" value="1"> Theo %
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="option" value="2"> Theo VND
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-sm-7" >
                <input type="text" class="form-control" name="MucGiam" id="MucGiam1" placeholder="Mức giảm %" disabled="">
                <input type="text" class="form-control" name="MucGiam" id="MucGiam2" placeholder="Mức giảm VND" disabled="">
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary pull-right">Thêm</button>
          </div>{{-- end card body --}}
        </div> 
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="card ">
            <div class="card-header card-header-rose card-header-text">
              <div class="card-icon">
                <i class="material-icons">library_books</i>
              </div>
              <h4 class="card-title">Thời gian bắt đầu</h4>
            </div>
            <div class="card-body ">
              <div class="form-group">
                <input type="text" class="form-control datepicker" value="{{Carbon\Carbon::now()}}" name="TG_BD">
              </div>
            </div>
          </div> {{-- end card datetime picker start date--}}
          <div class="card ">
            <div class="card-header card-header-rose card-header-text">
              <div class="card-icon">
                <i class="material-icons">library_books</i>
              </div>
              <h4 class="card-title">Thời gian kết thúc</h4>
            </div>
            <div class="card-body ">
              <div class="form-group">
                <input type="text" class="form-control datepicker" value="{{Carbon\Carbon::now()}}" name="TG_KT" >
              </div>
            </div>
          </div> {{-- end card datetime picker end date--}}
        </div>
      </div>
    </form>
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
            $.each(data, function(key, value){
              $("#show_option").append('<option value="'+value.ID+'">'+value.Name+'</option>');
            });
            $("#show_option").selectpicker("refresh");
          }
        });
    });

    //Ajax chuyển đổi mức giảm % và VND
    $('#add_coupon input[name="option"]').on('change', function() {
      var option= $('input[name="option"]:checked', '#add_coupon').val();
      if (option==1) {
        $("input[id='MucGiam1']").prop('disabled', false);
        $("input[id='MucGiam2']").prop('disabled', true);
      }else{
        $("input[id='MucGiam2']").prop('disabled', false);
        $("input[id='MucGiam1']").prop('disabled', true);
      }
    });

    $(function () {
      $('.datepicker').datetimepicker({
        format:'YYYY-MM-DD HH:mm:ss'
      });
    });
  });
</script>

@endsection
