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
                                <h1>LIÊN HỆ</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Liên Hệ</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- contact area start -->
        <div class="contact-area section-space pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-message">
                            <h2>Cho chúng tôi biết đánh giá của bạn</h2>
                            <form id="contact-form" action="http://whizthemes.com/mail-php/genger/mail.php" method="post" class="contact-form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="first_name" placeholder="Tên *" type="text" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="phone" placeholder="Số điện thoại *" type="text" required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input name="email_address" placeholder="Email *" type="text" required>
                                    </div>
                                    <div class="col-12">
                                        <div class="contact2-textarea text-center">
                                            <textarea placeholder="Đánh Giá *" name="message" class="form-control2" required="" style="resize: none"></textarea>
                                        </div>
                                        <p>Đánh Giá</p>
                                        <div class="stars">
                                            <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                                            <label class="star star-5" for="star-5"></label>
                                            <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                            <label class="star star-4" for="star-4"></label>
                                            <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
                                            <label class="star star-3" for="star-3"></label>
                                            <input class="star star-2" id="star-2" type="radio" name="star" value="2" />
                                            <label class="star star-2" for="star-2"></label>
                                            <input class="star star-1" id="star-1" type="radio" name="star" value="1" />
                                            <label class="star star-1" for="star-1"></label>
                                        </div>
                                        <div class="contact-btn">
                                            <button class="btn btn__bg" type="submit">Gửi Đánh Giá</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-info">
                            <div class="logo" align="center">
                                <a href="{{URL::to('/trang_chu')}}">
                                    <img src="{{asset('public/frontend/assets/img/logo_brand.png')}}" alt="">
                                </a>
                            </div>
                            <ul>
                                <li><i class="fa fa-fax"></i> Địa Chỉ : {{$contact_list->DiaChi}}</li>
                                <li><i class="fa fa-phone"></i>{{$contact_list->SoDienThoai}}</li>
                                <li><i class="fa fa-envelope-o"> {{$contact_list->Email}}</i></li>
                            </ul>
                            <?php
                            $Open = Carbon\Carbon::createFromFormat('H:i:s', $contact_list->Open)->format('g:i A');
                            $Close= Carbon\Carbon::createFromFormat('H:i:s', $contact_list->Close)->format('g:i A');
                            ?>
                            <div class="working-time">
                                <h3>Thời gian hoạt động</h3>
                                <p><span>Thứ 2 – Thứ 7:</span>{{$Open}} - {{$Close}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact area end -->
    </main>
    <!-- main wrapper end -->

@endsection