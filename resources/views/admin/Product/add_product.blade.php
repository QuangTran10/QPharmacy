@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">THÊM SẢN PHẨM</h4>
          </div>
        </div>
        <div class="card-body ">
          <form method="post" action="{{URL::to('/save_product')}}" class="form-horizontal" enctype="multipart/form-data" id="AddProduct">
            {{csrf_field() }}
            <p>
              <?php
                $message = Session::get('message');
                if($message){
                  echo $message;
                  Session::put('message',null);
                }
              ?>
            </p>
            <div class="row">
              <label class="col-sm-2 col-form-label">Tên Hàng Hoá</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="TenHangHoa" data-validation-length="min20" required="true" id="TenHangHoa">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Giá</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="Gia" id="Gia">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Loại Hàng</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="DanhMuc">
                    @foreach($category as $key => $value_cate)
                    <option value="{{$value_cate->MaDM}}">{{$value_cate->TenDanhMuc}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Nhà Sản Xuất</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="NSX">
                    @foreach($producer as $key => $value_nsx)
                    <option value="{{$value_nsx->MaNSX}}">{{$value_nsx->TenNSX}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Mô Tả</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <textarea class="form-control" name="MoTa" rows="6" id="ckeditor"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-4"></div>
              <div class="col-md-4 col-sm-4">
                <h4 class="title text-center">Hình Ảnh</h4>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                  <div class="fileinput-new thumbnail">
                    <img src="{{('public/backend/assets/img/image_placeholder.jpg')}}" alt="...">
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail"></div>
                  <div>
                    <span class="btn btn-rose btn-round btn-file">
                      <span class="fileinput-new">Chọn Hình Ảnh</span>
                      <span class="fileinput-exists">Thay Đổi</span>
                      <input type="file" name="HinhAnh[]" multiple/>
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Xoá</a>
                  </div>
                </div>
              </div>
            </div>
            <a href="{{URL::to('/product_management')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="add">Thêm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    //Ckeditor
    CKEDITOR.replace( 'ckeditor' );
    $( "#AddProduct" ).validate({
      rules: {
        TenHangHoa: {
          required: true
        },
        Gia:{
          required: true,
          number: true,
          digits: true
        },
      },
      messages: {
        TenHangHoa: "Tên hàng hoá không được để trống",
        Gia:{
          required: "Giá không để trống",
          number: "Giá phải là số",
          digits: "Giá không là số âm"
        },
      }
    });
  });
</script>

@endsection
