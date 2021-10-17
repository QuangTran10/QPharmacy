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
                                        <a href="#account-info" class="active" data-toggle="tab"><i class="fa fa-user"></i>
                                        Thông Tin Cá Nhân</a>
                                        <a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i>
                                        Đổi Mật Khẩu</a>
                                        <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i>
                                        Địa Chỉ Nhận Hàng</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        @if(session('notice'))
                                        <p style="color: red;">
                                            {{session('notice')}}
                                        </p>
                                        @endif
                                        <div class="tab-pane fade" id="download" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Thay Đổi Mật Khẩu</h3>
                                                <div class="account-details-form">
                                                    <form id="Change_pass" action="{{URL::to('/change_password')}}" method="post">
                                                        {{csrf_field()}}
                                                        <fieldset>
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Tên Tài Khoản</label>
                                                                <input type="text" name="username" id="username" />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">Mật Khẩu Mới</label>
                                                                        <input type="password" name="new_pwd" id="new_pwd" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Nhập Lại Mật Khẩu</label>
                                                                        <input type="password" name="confirm_pwd" id="confirm_pwd" />
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
                                        <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Địa Chỉ Nhận Hàng</h3>
                                                @foreach($address_ship as $key => $add)
                                                <form>
                                                    @csrf
                                                    <address>
                                                        <p><strong>{{$add->HoTen}}</strong></p>
                                                        <p>{{$add->DiaChi}}</p>
                                                        <p>Số điện thoại: {{$add->SDT}}</p>
                                                    </address>
                                                    <a href="#" data-id_address="{{$add->MaDC}}" class="btn btn__bg update_add" data-toggle="modal" data-target="#address_edit"><i class="fa fa-edit"></i>
                                                    Sửa Địa Chỉ</a>
                                                    <hr>
                                                </form>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade active" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Thông Tin Cá Nhân</h3>
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

    <!-- Quick view modal start -->
    <div class="modal" id="address_edit">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-3 col-md-3"></div>
                            <div class="col-lg-6 col-md-6">
                                <h3 style="text-align: center;">ĐỊA CHỈ NHẬN HÀNG</h3>
                                <form action="{{URL::to('/update_address')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="single-input-item" id="HoTen">
                                        
                                    </div>

                                    <div class="single-input-item" id="SDT">
                                        
                                    </div>

                                    <div class="single-input-item" id="DiaChi">
                                        
                                    </div>
                                    <div id="MaDC">
                                        
                                    </div>
                                    <div class="single-input-item">
                                        <input type="submit" name="SuaDC" class="btn btn__bg" value="Hoàn Thành">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- Quick view modal end --> 
</main>
<!-- main wrapper end -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.update_add').click(function() {
            var MaDC = $(this).data('id_address');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/show_address')}}',
                method: "POST",
                dataType: "JSON",
                data:{
                    MaDC:MaDC,
                    _token:_token
                },
                success:function(data){
                    $('#HoTen').html(data.HoTen);
                    $('#SDT').html(data.SDT);
                    $('#DiaChi').html(data.DiaChi);
                    $('#MaDC').html(data.MaDC);
                }
            });
        });
        $( "#Change_pass" ).validate({
            rules: {
                username: {
                    required: true
                },
                new_pwd:{
                    required: true,
                    minlength: 8
                },
                confirm_pwd:{
                    required: true,
                    equalTo: "#new_pwd"
                },
            },
            messages: {
                username:{
                    required: "Tên tài khoản không bỏ trống"
                },
                new_pwd:{
                    required: "Mật khẩu không để trống",  
                    minlength: "Mật Khẩu phải ít nhất 8 ký tự"
                },
                confirm_pwd:{
                    required: "Không để trống",
                    equalTo: "Nhập lại mật khẩu không đúng"
                },
            }
        });
    });
</script>
@endsection    