@extends('welcome')
@section('contend')     
    <!-- main wrapper start -->
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area common-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <h1>đăng ký</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">đăng ký</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- login register wrapper start -->
        <div class="login-register-wrapper section-space pb-0">
            <div class="container">
                <div class="member-area-from-wrap">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <!-- Register Content Start -->
                        <div class="col-lg-6">
                            <div class="login-reg-form-wrap sign-up-form">
                                <form action="{{URL::to('/register')}}" method="post" id="Register">
                                    {{csrf_field() }}
                                    <div class="single-input-item">
                                        <input type="text" name="HoTenKH" placeholder="Họ Và Tên" required id="HoTenKH" />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="email" name="Email" placeholder="Email" required id="Email" />
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="single-input-item">
                                                <select name="GioiTinh">
                                                    <option value="0">Nữ</option>
                                                    <option value="1">Nam</option>
                                                    <option  value="2">Khác</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="single-input-item">
                                                <input type="text" name="SDT" placeholder="Số Điện Thoại" required id="SDT" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="single-input-item">
                                                <label>Ngày</label>
                                                <select name="Ngay" id="Ngay">
                                                    <?php
                                                        for ($i=1; $i <=31 ; $i++) { 
                                                    ?>
                                                        <option value="<?php echo $i?>">
                                                            <?php echo $i?>
                                                        </option>
                                                    <?php        
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="single-input-item">
                                                <label>Tháng</label>
                                                <select name="Thang" id="Thang">
                                                     <?php
                                                        for ($i=1; $i <=12 ; $i++) { 
                                                    ?>
                                                        <option value="<?php echo $i?>">
                                                            <?php echo $i?>
                                                        </option>
                                                    <?php        
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="single-input-item">
                                                <label>Năm</label>
                                                <select name="Nam" id="Nam">
                                                    <?php
                                                    $date = getdate();
                                                        for ($i=1990; $i <=$date['year'] ; $i++) { 
                                                    ?>
                                                        <option value="<?php echo $i?>">
                                                            <?php echo $i?>
                                                        </option>
                                                    <?php        
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <input type="text" name="TaiKhoan" placeholder="Tên đăng nhập" id="TaiKhoan" />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" name="MatKhau" placeholder="Mật khẩu" id="MatKhau" />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" name="MatKhau1" placeholder="Lặp lại mật khẩu" id="MatKhau1" />
                                    </div>
                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta">
                                            <div class="remember-meta">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="subnewsletter" name="Check" value="1">
                                                    <label class="custom-control-label" for="subnewsletter">Đồng ý với các điều khoản</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <input type="submit" name="DangKi" class="btn btn__bg" value="Đăng Ký">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Register Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>
    <!-- main wrapper end -->
    <script type="text/javascript">
  $(document).ready(function() {
    jQuery.validator.addMethod("phoneVN", function(value, element) {
          // allow any non-whitespace characters as the host part
          return this.optional( element ) || /^(0){1}[0-9]{9,10}$/.test( value );
      }, 'Số điện thoại không hợp lệ.');
    $( "#Register" ).validate({
      rules: {
        HoTenKH: {
          required: true
        },
        Email:{
          required: true,
          email: true
        },
        TaiKhoan:{
            required: true
        },
        MatKhau:{
          required: true,
          minlength: 8
        },
        MatKhau1:{
          required: true,
          equalTo: "#MatKhau"
        },
        SDT:{
          required: true,
          phoneVN: true
        },
      },
      messages: {
        HoTenKH: "Họ Tên không được để trống",
        Email:{
          required: "Email không để trống",
          email: "Không phải email"
        },
        TaiKhoan:{
            required: "Tên tài khoản không bỏ trống"
        },
        MatKhau:{
          required: "Mật khẩu không để trống",  
          minlength: "Mật Khẩu phải ít nhất 8 ký tự"
        },
        MatKhau1:{
          required: "Không để trống",
          equalTo: "Nhập lại mật khẩu không đúng"
        },
        SDT:{
          required: "Số điện thoại không để trống"
        },
      }
    });
  });
</script>
@endsection      