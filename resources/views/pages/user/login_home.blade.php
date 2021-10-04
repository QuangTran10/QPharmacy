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
                                <h1>đăng nhập</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">đăng nhập</li>
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
                        <!-- Login Content Start -->
                        <div class="col-lg-6">
                            <div class="login-reg-form-wrap">
                                <form action="{{URL::to('/login')}}" method="post">
                                    {{ csrf_field() }}
                                    @if(session('notice'))
                                    <p style="color: red; text-align: center;">
                                        {{session('notice')}}
                                    </p>
                                    @endif
                                    <div class="single-input-item">
                                        <input type="text" name="TaiKhoan" placeholder="Tài Khoản" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" name="MatKhau" placeholder="Mật Khẩu" required />
                                    </div>
                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                    <label class="custom-control-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                                                </div>
                                            </div>
                                            <a href="#" class="forget-pwd">Quên Mật Khẩu?</a>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <input type="submit" name="DangNhap" class="btn btn__bg" value="Đăng Nhập">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>
    <!-- main wrapper end -->
@endsection      