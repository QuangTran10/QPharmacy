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
                                <form action="{{URL::to('/register')}}" method="post">
                                    {{csrf_field() }}
                                    <div class="single-input-item">
                                        <input type="text" name="HoTenKH" placeholder="Họ Và Tên" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="email" name="Email" placeholder="Email" required />
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
                                                <input type="text" name="SDT" placeholder="Số Điện Thoại" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="single-input-item">
                                                <label>Ngày</label>
                                                <select name="Ngay">
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
                                                <select name="Thang">
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
                                                <select name="Nam">
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
                                        <input type="text" name="TaiKhoan" placeholder="Tên đăng nhập" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" name="MatKhau" placeholder="Mật khẩu" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" name="MatKhau1" placeholder="Lặp lại mật khẩu" required />
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
@endsection      