@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <form method="post" action="{{URL::to('/save_receipt')}}" class="form-horizontal">
        {{csrf_field() }}
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">PHIẾU THU</h4>
            </div>
          </div>
          <div class="card-body ">

            <p>
              
            </p>
            <div class="form-group">
              <label class="bmd-label-floating">Ghi Chú</label>
              <textarea class="form-control" name="GhiChu" rows="3" ></textarea>
            </div>
            
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nhà Cung Cấp</label>
                  <div class="form-group">
                    <select class="selectpicker" data-style="select-with-transition" name="MaNCC" required>
                      @foreach($supplier as $key => $value)
                      <option value="{{$value->MaNCC}}">{{$value->TenNCC}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Tình Trạng</label>
                  <div class="form-group">
                    <select class="selectpicker" data-style="select-with-transition" name="TinhTrang" required>
                      <option value="1">Đã Thanh Toán</option>
                      <option value="0">Ghi Nợ</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <div>
          <div class="card">
            <div class="card-body" id="receipt">
              @if(session('row'))
                @php 
                $product_import = session('row');
                $i = 1;
                @endphp
                @foreach($product_import as $value)
                <div class="row" id="element{{$i}}">
                  <div class="form-group col-4">
                    <select class="form-select" name="Product[]" required>
                     @foreach($product as $key => $val)
                      <option value="{{$val->MSSP}}" {{($value['MSSP']==$val->MSSP)? "selected" : "" }}>{{$val->TenSP}}</option>
                     @endforeach
                    </select>
                  </div>
                  <div class="form-group col-3">
                    <input type="number" class="form-control" name="Quantity[]" placeholder="Số Lượng" required min="0" value="{{$value['SoLuong']}}">
                  </div>
                  <div class="form-group col-3">
                    <input type="number" class="form-control" name="Price[]" placeholder="Giá nhập hàng" min="1000" required value="{{$value['DonGia']}}">
                  </div>
                  <div class="form-group col-1">
                    <a type="button" rel="tooltip" style="color:white" class="btn btn-info btn-sm remove-el" data-id="1"><i class="material-icons">delete_outline</i></a>
                  </div>
                </div>
                @php 
                  $i++;
                @endphp
                @endforeach
              @else
                <div class="row" id="element1">
                  <div class="form-group col-5">
                    <select class="form-select" name="Product[]" required>
                     @foreach($product as $key => $val)
                      <option value="{{$val->MSHH}}">{{$val->TenHH}}</option>
                     @endforeach
                    </select>
                  </div>
                  <div class="form-group col-2">
                    <input type="number" class="form-control" name="Quantity[]" placeholder="Số Lượng" required min="0">
                  </div>
                  <div class="form-group col-3">
                    <input type="number" class="form-control" name="Price[]" placeholder="Giá nhập hàng" min="1000" required>
                  </div>
                  <div class="form-group col-1">
                    <a type="button" rel="tooltip" style="color:white" class="btn btn-info btn-sm remove-el" data-id="1"><i class="material-icons">delete_outline</i></a>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
        
        @if(session('row'))
        <input type="hidden" id="i" value="{{$i-1}}" name="index">
        @else
        <input type="hidden" id="i" value="1" name="index">
        @endif
        <button type="submit" class="btn btn-primary pull-right" name="add">Thêm</button> 
      </form>
      <a href="{{URL::to('/show_receipt')}}" class="btn btn-primary">Trở Về</a>
      <button class="btn btn-success add-component"><span class="btn-label"><i class="material-icons">add</i></span>Thêm Sản Phẩm</button>
      <button type="button" rel="tooltip" class="btn btn-warning" data-toggle="modal" data-target="#importModal">
        <i class="material-icons">file_upload</i>Import
      </button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.add-component').click(function(event) {
      var i = $('#i').val();
      var u = Number(i) + 1;
      $('#receipt').append('<div class="row" id="element'+u+'"><div class="form-group col-5"><select class="form-select" name="Product[]" required>@foreach($product as $key => $val)<option value="{{$val->MSHH}}">{{$val->TenHH}}</option>@endforeach</select></div><div class="form-group col-2"><input type="number" class="form-control" name="Quantity[]" placeholder="Số Lượng" required min="0"></div><div class="form-group col-3"><input type="number" class="form-control" name="Price[]" placeholder="Giá nhập hàng" min="1000" required></div><div class="form-group col-1"><a type="button" rel="tooltip" style="color:white" class="btn btn-info btn-sm remove-el" data-id="'+u+'"><i class="material-icons">delete_outline</i></a></div></div>');
      $('#i').val(u);
    });

    $('#receipt').on('click', '.remove-el', function(event) {
      var id = $(this).data('id');
      var i = $('#i').val();
      var u = Number(i) - 1;
      $('#i').val(u);
      $('#element'+id).remove();

    });
  });
</script>
@endsection
