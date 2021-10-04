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
                            <h1>TÀI KHOẢN CỦA TÔI</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tài Khoản Của Tôi</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- my account wrapper start -->
    <div class="my-account-wrapper section-space pb-0">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        {{-- <a href="#dashboad"  data-toggle="tab"><i class="fa fa-dashboard"></i>
                                        Dashboard</a> --}}
                                        <a href="#account-info" class="active" data-toggle="tab"><i class="fa fa-user"></i>
                                        Thông Tin Cá Nhân</a>
                                        <a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i>
                                        Đổi Mật Khẩu</a>
                                        <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i>Payment Method</a>
                                        <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i>
                                        Địa Chỉ Nhận Hàng</a>
                                        <a href="{{URL::to('/logout_user')}}"><i class="fa fa-sign-out"></i> Đăng Xuất</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        {{-- <div class="tab-pane fade show" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                    <p>Hello, <strong>Erik Jhonson</strong> (If Not <strong>Jhonson
                                                    !</strong><a href="login-register.html" class="logout"> Logout</a>)</p>
                                                </div>
                                                <p class="mb-0">From your account dashboard. you can easily check &
                                                    view your recent orders, manage your shipping and billing addresses
                                                and edit your password and account details.</p>
                                            </div>
                                        </div> --}}
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="download" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Thay Đổi Mật Khẩu</h3>
                                                <div class="account-details-form">
                                                    <form action="{{URL::to('/change_password')}}" method="post">
                                                        {{csrf_field()}}
                                                        <fieldset>
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Mật Khẩu Hiện Tại</label>
                                                                <input type="password" name="current_pwd" placeholder="Current Password" />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">Mật Khẩu Mới</label>
                                                                        <input type="password" name="new_pwd" placeholder="New Password" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Nhập Lại Mật Khẩu</label>
                                                                        <input type="password" name="confirm_pwd" placeholder="Confirm Password" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item">
                                                            <button type="submit" class="btn btn__bg">XÁC NHẬN</button>
                                                        </div> 
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Payment Method</h3>
                                                <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Billing Address</h3>
                                                <address>
                                                    <p><strong>Erik Jhonson</strong></p>
                                                    <p>1355 Market St, Suite 900 <br>
                                                    San Francisco, CA 94103</p>
                                                    <p>Mobile: (123) 456-7890</p>
                                                </address>
                                                <a href="#" class="btn btn__bg"><i class="fa fa-edit"></i>
                                                Edit Address</a>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade active" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Account Details</h3>
                                                <div class="account-details-form">
                                                    @foreach($user_infor as $key => $value)
                                                    <form action="{{URL::to('/change_info')}}" method="post">
                                                        {{csrf_field()}}
                                                        <div class="single-input-item">
                                                            <label for="first-name" class="required">Họ Và Tên</label>
                                                            <input type="text" name="HoTenKH" placeholder="Họ và tên" value="{{$value->HoTenKH}}" />
                                                        </div>

                                                        <div class="single-input-item">
                                                            <label for="display-name" class="required">Tên Tài Khoản</label>
                                                            <input type="text" name="TaiKhoan" placeholder="Tên tài khoản" value="{{$value->TaiKhoan}}"/>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email</label>
                                                            <input type="email" name="Email" placeholder="Email" value="{{$value->Email}}"/>
                                                        </div>

                                                        

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="text" class="required">Số Điện Thoại</label>
                                                                    <input type="text" name="SDT" placeholder="Số điện thoại" value="{{$value->SoDienThoai}}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="text" class="required">Giới Tính</label>
                                                                    <select name="GioiTinh">
                                                                        <option value="0" {{ ($value->GioiTinh=='0')? "selected" : ""}} >Nữ</option>
                                                                        <option value="1" {{ ($value->GioiTinh=='1')? "selected" : ""}}>Nam</option>
                                                                        <option  value="2" {{ ($value->GioiTinh=='2')? "selected" : ""}}>Khác</option>
                                                                    </select>
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
                                                                        <option value="<?php echo $i?>" {{ ($value->Ngay==$i)? "selected" : "" }}>
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
                                                                        <option value="<?php echo $i?>" {{ ($value->Thang==$i)? "selected" : "" }}>
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
                                                                        <option value="<?php echo $i?>" {{ ($value->Nam==$i)? "selected" : "" }}>
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
                                                            <button type="submit" class="btn btn__bg">Xác Nhận</button>
                                                        </div>
                                                    </form>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->
</main>
<!-- main wrapper end -->
@endsection    