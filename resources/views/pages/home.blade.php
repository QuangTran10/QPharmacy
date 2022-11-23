@extends('welcome')
@section('contend')   

<main>         
<!-- slider area start -->
        <section class="slider-area">
            <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
                <!-- single slider item start -->
                <div class="hero-single-slide ">
                    <div class="hero-slider-item bg-img" data-bg="{{asset('public/frontend/assets/img/slider/poster1.png')}}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-1">
                                        {{-- <span style="color: green">Chào Hè</span> --}}
                                        {{-- <h1 style="color: #FDE357"><b>Chào Hè</b></h1> --}}
                                        {{-- <h2>& Feeling love</h2> --}}
                                        {{-- <a href="" class="btn-hero">Mua Ngay</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item end -->

                <!-- single slider item start -->
                <div class="hero-single-slide">
                    <div class="hero-slider-item bg-img" data-bg="{{asset('public/frontend/assets/img/slider/poster2.png')}}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-2">
                                        {{-- <span>Chào Trung Thu</span>
                                        <h1 style="color: yellow;">Tết Trung thu</h1>
                                        <h2 style="color: yellow;">trao gửi ân tình</h2> --}}
                                        {{-- <a href="" class="btn-hero">Mua Ngay</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->

                <!-- single slider item start -->
                <div class="hero-single-slide">
                    <div class="hero-slider-item bg-img" data-bg="{{asset('public/frontend/assets/img/slider/poster3.png')}}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <div class="hero-slider-content slide-2">
                                        <span>Chào Trung Thu</span>
                                        <h1 style="color: yellow;">Tết Trung thu</h1>
                                        <h2 style="color: yellow;">trao gửi ân tình</h2>
                                        <a href="shop.html" class="btn-hero">Mua Ngay</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->
            </div>
        </section>
        <!-- slider area end -->

        <!-- banner statistics start -->
        <section class="banner-statistics section-space">
            <div class="container">
                <div class="row mbn-30">
                    <!-- start store item -->
                    <div class="col-md-4">
                        <div class="banner-item mb-30">
                            <figure class="banner-thumb">
                                <a href="#">
                                    <img src="{{asset('public/frontend/assets/img/banner/task1.png')}}" alt="">
                                </a>
                                {{-- <figcaption class="banner-content">
                                    <h2 class="text1">Siêu Ưu Đãi</h2>
                                    <h2 class="text2">Yellow Gold</h2>
                                    <a class="store-link" href="#">Mua Ngay</a>
                                </figcaption> --}}
                            </figure>
                        </div>
                    </div>
                    <!-- start store item -->

                    <!-- start store item -->
                    <div class="col-md-4">
                        <div class="banner-item mb-30">
                            <figure class="banner-thumb">
                                <a href="#">
                                    <img src="{{asset('public/frontend/assets/img/banner/task2.jpg')}}" alt="">
                                </a>
                                {{-- <figcaption class="banner-content text-center">
                                    <h2 class="text1">Chào Tháng 9</h2>
                                    <h2 class="text2">Orchid stick</h2>
                                    <a class="store-link" href="#">Mua Ngay</a>
                                </figcaption> --}}
                            </figure>
                        </div>
                    </div>
                    <!-- start store item -->

                    <!-- start store item -->
                    <div class="col-md-4">
                        <div class="banner-item mb-30">
                            <figure class="banner-thumb">
                                <a href="#">
                                    <img src="{{asset('public/frontend/assets/img/banner/task3.png')}}" alt="">
                                </a>
                                {{-- <figcaption class="banner-content">
                                    <h2 class="text1">Giảm 10%</h2>
                                    <h2 class="text2">tulip flower</h2>
                                    <a class="store-link" href="#">Mua Ngay</a>
                                </figcaption> --}}
                            </figure>
                        </div>
                    </div>
                    <!-- start store item -->
                </div>
            </div>
        </section>
        <!-- banner statistics end -->

        <!-- service policy start -->
        <section class="service-policy-area section-space p-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <!-- start policy single item -->
                        <div class="service-policy-item">
                            <div class="icons">
                                <img src="{{asset('public/frontend/assets/img/icon/free_shipping.png')}}" alt="">
                            </div>
                            <div class="policy-terms">
                                <h5>Miễn phí giao hàng</h5>
                                <p>Miễn phí cho đơn hàng khu vực nội ô</p>
                            </div>
                        </div>
                        <!-- end policy single item -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <!-- start policy single item -->
                        <div class="service-policy-item">
                            <div class="icons">
                                <img src="{{asset('public/frontend/assets/img/icon/support247.png')}}" alt="">
                            </div>
                            <div class="policy-terms">
                                <h5>Hỗ trợ 24/7</h5>
                                <p>Hỗ trợ và tư vấn mọi lúc</p>
                            </div>
                        </div>
                        <!-- end policy single item -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <!-- start policy single item -->
                        <div class="service-policy-item">
                            <div class="icons">
                                <img src="{{asset('public/frontend/assets/img/icon/money_back.png')}}" alt="">
                            </div>
                            <div class="policy-terms">
                                <h5>Hoàn Tiền</h5>
                                <p>Hoàn tiền nếu sản phẩm không giống như hình ảnh</p>
                            </div>
                        </div>
                        <!-- end policy single item -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <!-- start policy single item -->
                        <div class="service-policy-item">
                            <div class="icons">
                                <img src="{{asset('public/frontend/assets/img/icon/promotions.png')}}" alt="">
                            </div>
                            <div class="policy-terms">
                                <h5>Khuyến Mãi</h5>
                                <p>Nhiều chương trình giảm giá</p>
                            </div>
                        </div>
                        <!-- end policy single item -->
                    </div>
                </div>
            </div>
        </section>
        <!-- service policy end -->

        <!-- our product area start -->
        <section class="our-product section-space">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2>Sản phẩm mới</h2>
                        </div>
                    </div>
                </div>
                <div class="row mtn-40">
                    <!-- product single item start -->
                    @foreach($new_product as $key =>$value)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-item mt-40">
                            <figure class="product-thumb">
                                <a href="{{URL::to('/product_details/'.$value->MSHH.'?new=1')}}">
                                    <img class="pri-img" src="{{asset('public/upload/'.$value->HinhAnh)}}" alt="product">
                                    <img class="sec-img" src="{{asset('public/upload/'.$value->HinhAnh)}}" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Mới</span>
                                    </div>
                                    @if($value->GiamGia!=0)
                                    <div class="product-label discount">
                                        <span>{{$value->GiamGia*100}}%</span>
                                    </div>
                                    @endif
                                </div>
                                <form>
                                    {{csrf_field()}}
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <input type="hidden" name="Id_{{$value->MSHH}}" value="{{$value->MSHH}}" class="cart_product_id_{{$value->MSHH}}">
                                        <input type="hidden" name="Name" value="{{$value->TenHH}}" class="cart_product_name_{{$value->MSHH}}">
                                        <input type="hidden" name="Image" value="{{$value->HinhAnh}}" class="cart_product_image_{{$value->MSHH}}">
                                        <input type="hidden" name="Price" value="{{$value->Gia}}" class="cart_product_price_{{$value->MSHH}}">
                                        <input type="hidden" name="Discount" value="{{$value->GiamGia}}" class="cart_product_discount_{{$value->MSHH}}">
                                        <input type="hidden" name="SoLuong" value="1" class="cart_product_qty_{{$value->MSHH}}">
                                    </div>    
                                </form>
                                <div class="button-group">
                                    <a href="#" class="add_favourite" data-toggle="tooltip" data-placement="left" data-id_product={{$value->MSHH}}><i class="lnr lnr-heart"></i></a>
                                    <a href="#" class="quick_view" data-toggle="modal" data-target="#quick_view" data-id_product={{$value->MSHH}}><span data-toggle="tooltip" data-placement="left" ><i class="lnr lnr-magnifier"></i></span></a>
                                    @if($value->SoLuongHang!=0)
                                    <button><a data-id="{{$value->MSHH}}" data-toggle="tooltip" data-placement="left" class="add_cart" ><i class="lnr lnr-cart"></i></a></button>
                                    @endif
                                </div>
                            </figure>
                            <div class="product-caption">
                                <p class="product-name">
                                    <a href="{{URL::to('/product_details/'.$value->MSHH)}}">{{$value->TenHH}}</a>
                                </p>
                                <div class="price-box">
                                    @if($value->GiamGia!=0)    
                                    <span class="price-regular">
                                        <?php
                                        $GiaSP = number_format($value->Gia*(1-$value->GiamGia), 0, ',', ' ');
                                        echo $GiaSP." đ";
                                        ?>
                                    </span>
                                    <span class="price-old"><del>{{$value->Gia}}</del></span>
                                    @else
                                    <span class="price-regular">
                                        <?php
                                        $GiaSP = number_format($value->Gia, 0, ',', ' ');
                                        echo $GiaSP." đ";
                                        ?>
                                    </span>
                                    @endif    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- product single item end -->

                    <div class="col-12">
                        <div class="view-more-btn">
                            <a class="btn-hero btn-load-more" href="{{URL::to('/show_all_product')}}">Xem Thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- our product area end -->

        <!-- banner statistics start -->
        <section class="banner-statistics-right">
            <div class="container">
                <div class="row">
                    <!-- start banner item start -->
                    <div class="col-md-6">
                        <div class="banner-item banner-border">
                            <figure class="banner-thumb">
                                <a href="#">
                                    <img src="{{('public/frontend/assets/img/banner/task4.png')}}" alt="">
                                </a>
                                {{-- <figcaption class="banner-content banner-content-right">
                                    <h2 class="text1">for you</h2>
                                    <h2 class="text2">Tulip Flower</h2>
                                    <a class="store-link" href="#">shop now</a>
                                </figcaption> --}}
                            </figure>
                        </div>
                    </div>
                    <!-- start banner item end -->

                    <!-- start banner item start -->
                    <div class="col-md-6">
                        <div class="banner-item banner-border">
                            <figure class="banner-thumb">
                                <a href="#">
                                    <img src="{{('public/frontend/assets/img/banner/task5.png')}}" alt="">
                                </a>
                                {{-- <figcaption class="banner-content banner-content-right">
                                    <h2 class="text1">for you</h2>
                                    <h2 class="text2">Flower & Box</h2>
                                    <a class="store-link" href="#">shop now</a>
                                </figcaption> --}}
                            </figure>
                        </div>
                    </div>
                    <!-- start banner item end -->
                </div>
            </div>
        </section>
        <!-- banner statistics end -->

        <!-- trending product area start -->
        <section class="top-sellers section-space">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2>bán chạy</h2>
                            <!-- <p>Accumsan vitae pede lacus ut ullamcorper sollicitudin quisque libero</p> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-carousel--4 slick-row-15 slick-sm-row-10 slick-arrow-style">
                            <!-- product single item start -->
                            @foreach($pro_best_seller as $pro_val)
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="{{URL::to('/product_details/'.$pro_val->MSHH)}}">
                                        <img class="pri-img" src="{{asset('public/upload/'.$pro_val->HinhAnh)}}" alt="product">
                                        <img class="sec-img" src="{{asset('public/upload/'.$pro_val->HinhAnh)}}" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        @if($pro_val->GiamGia!=0)
                                        <div class="product-label discount">
                                            <span>{{$pro_val->GiamGia*100}}%</span>
                                        </div>
                                        @endif
                                    </div>
                                    <form>
                                        {{csrf_field()}}
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <input type="hidden" name="Id_{{$pro_val->MSHH}}" value="{{$pro_val->MSHH}}" class="cart_product_id_{{$pro_val->MSHH}}">
                                            <input type="hidden" name="Name" value="{{$pro_val->TenHH}}" class="cart_product_name_{{$pro_val->MSHH}}">
                                            <input type="hidden" name="Image" value="{{$pro_val->HinhAnh}}" class="cart_product_image_{{$pro_val->MSHH}}">
                                            <input type="hidden" name="Price" value="{{$pro_val->Gia}}" class="cart_product_price_{{$pro_val->MSHH}}">
                                            <input type="hidden" name="SoLuong" value="1" class="cart_product_qty_{{$pro_val->MSHH}}">
                                            <input type="hidden" name="Discount" value="{{$pro_val->GiamGia}}" class="cart_product_discount_{{$pro_val->MSHH}}">
                                        </div>    
                                    </form>
                                    <div class="button-group">
                                        <a href="" data-toggle="tooltip" data-placement="left" ><i class="lnr lnr-heart"></i></a>
                                        <a href="#" class="quick_view" data-toggle="modal" data-target="#quick_view" data-id_product={{$pro_val->MSHH}}><span data-toggle="tooltip" data-placement="left" ><i class="lnr lnr-magnifier"></i></span></a>
                                        @if($pro_val->SoLuongHang!=0)
                                        <button><a data-id="{{$pro_val->MSHH}}" data-toggle="tooltip" data-placement="left" class="add_cart" ><i class="lnr lnr-cart"></i></a></button>
                                        @endif
                                    </div>
                                </figure>
                                <div class="product-caption">
                                    <p class="product-name">
                                        <a href="{{URL::to('/product_details/'.$pro_val->MSHH)}}">{{$pro_val->TenHH}}
                                        </a>
                                    </p>
                                    <div class="price-box">
                                        @if($pro_val->GiamGia!=0)    
                                        <span class="price-regular">
                                            <?php
                                            $GiaSP = number_format($pro_val->Gia*(1-$pro_val->GiamGia), 0, ',', ' ');
                                            echo $GiaSP." đ";
                                            ?>
                                        </span>
                                        <span class="price-old"><del>{{$pro_val->Gia}}</del></span>
                                        @else
                                        <span class="price-regular">
                                            <?php
                                            $GiaSP = number_format($pro_val->Gia, 0, ',', ' ');
                                            echo $GiaSP." đ";
                                            ?>
                                        </span>
                                        @endif 
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- product single item end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- trending product area end -->

        <!-- Instagram Feed Area Start -->
        <div class="instagram-feed-area">
            <div class="instagram-feed-thumb">
                <div id="instafeed" class="instagram-carousel" data-userid="6666969077" data-accesstoken="6666969077.1677ed0.d325f406d94c4dfab939137c5c2cc6c2">
                </div>
            </div>
        </div>
        <!-- Instagram Feed Area End -->
</main>        
@endsection         