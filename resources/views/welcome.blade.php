<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <title>{{$meta_tittle}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Seo meta ===-->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url}}" />


    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="{{asset('public/frontend/assets/img/logo_brand.png')}}" type="image/x-icon" />

    <!-- Google fonts include -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,900%7CYesteryear" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>

    <!-- All Vendor & plugins CSS include -->
    <link href="{{asset('public/frontend/assets/css/vendor.css')}}" rel="stylesheet">
    <!-- Main Style CSS -->
    <link href="{{asset('public/frontend/assets/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('public/frontend/assets/css/sweetalert.css')}}" rel="stylesheet">

    <script src="{{asset('public/frontend/assets/js/jquery-3.6.0.js')}}"></script>
    <!--[if lt IE 9]>
<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

    <!-- Start Header Area -->
    <header class="header-area">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header top start -->
            <div class="header-top bdr-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="welcome-message">
                                <p>Chào mừng 
                                <b>
                                    <?php
                                    $name_user= Session::get('user_name');
                                    if($name_user){
                                        echo $name_user;
                                    }
                                    ?>
                                </b> 
                                đến QPharmacy</p>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="header-top-settings">
                                <ul class="nav align-items-center justify-content-end">
                                    <li class="language">
                                        <span>Ngôn Ngữ</span>
                                        <img src="{{asset('public/frontend/assets/img/icon/vn.png')}}" alt="flag"> Việt Nam
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="dropdown-list">
                                            <li><a href="#"><img src="{{asset('public/frontend/assets/img/icon/en.png')}}" alt="flag"> english</a></li>
                                            <li><a href="#"><img src="{{asset('public/frontend/assets/img/icon/vn.png')}}" alt="flag"> Việt Nam</a></li>
                                        </ul>
                                    </li>
                                    <li class="curreny-wrap">
                                        <span>Đơn Vị Tiền Tệ</span>
                                        VND
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header top end -->

            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-3">
                            <div class="logo">
                                <a href="{{URL::to('/trang_chu')}}">
                                    <img src="{{asset('public/frontend/assets/img/logo_brand.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-6 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li class="active"><a href="{{URL::to('/trang_chu')}}">Trang Chủ</a></li>
                                            <li class="static"><a href="#">Sản Phẩm <i class="fa fa-angle-down"></i></a>
                                                <ul class="megamenu dropdown">
                                                    <li class="mega-title"><a href="#">Danh Mục</a>
                                                        <ul>
                                                        @foreach($category as $key => $value_cate)
                                                            @if($value_cate->MaLoaiHang %2 ==0)    
                                                            <li>
                                                                <a href="{{URL::to('/category_home/'.$value_cate->MaLoaiHang)}}">{{$value_cate->TenLoaiHang}}</a>
                                                            </li>
                                                            @endif
                                                        @endforeach
                                                        </ul>
                                                    </li>
                                                    <li class="mega-title"><a href="#"></a>
                                                        <ul>
                                                        @foreach($category as $key => $value_cate)    
                                                            @if($value_cate->MaLoaiHang %2 !=0)    
                                                            <li>
                                                                <a href="{{URL::to('/category_home/'.$value_cate->MaLoaiHang)}}">{{$value_cate->TenLoaiHang}}</a>
                                                            </li>
                                                            @endif
                                                        @endforeach    
                                                        </ul>
                                                    </li>
                                                    <li class="mega-title"><a href="#">Nhà Sản Xuất</a>
                                                        <ul>
                                                        @foreach($producer as $key => $value_pro)    @if($value_pro->MaNSX %2 ==0)
                                                            <li>
                                                                <a href="{{URL::to('/producer_home/'.$value_pro->MaNSX)}}">{{$value_pro->TenNSX}}</a>
                                                            </li>
                                                            @endif
                                                        @endforeach
                                                        </ul>
                                                    </li>
                                                    <li class="mega-title">
                                                        <ul>
                                                        @foreach($producer as $key => $value_pro)    @if($value_pro->MaNSX %2 !=0)
                                                            <li>
                                                                <a href="{{URL::to('/producer_home/'.$value_pro->MaNSX)}}">{{$value_pro->TenNSX}}</a>
                                                            </li>
                                                            @endif
                                                        @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="shop.html">Tin Tức <i class="fa fa-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    <li><a href="#">shop grid layout <i class="fa fa-angle-right"></i></a>
                                                        <ul class="dropdown">
                                                            <li><a href="">shop grid left sidebar</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">shop list layout <i class="fa fa-angle-right"></i></a>
                                                        <ul class="dropdown">
                                                            <li><a href="">shop list left sidebar</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">products details <i class="fa fa-angle-right"></i></a>
                                                        <ul class="dropdown">
                                                            <li><a href="product-details.html">product details</a></li>
                                                            <li><a href="product-details-affiliate.html">product details affiliate</a></li>
                                                            <li><a href="product-details-variable.html">product details variable</a></li>
                                                            <li><a href="product-details-group.html">product details group</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="">Liên Hệ</a></li>
                                            <li><a href="">Giới Thiệu</a></li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-3">
                            <div class="header-configure-wrapper">
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end" >
                                        <li>
                                            <a href="#" class="offcanvas-btn">
                                                <i class="lnr lnr-magnifier"></i>
                                            </a>
                                        </li>
                                        <li class="user-hover">
                                            <a href="{{URL::to('/login_home')}}">
                                                <i class="lnr lnr-user"></i>
                                            </a>
                                            <ul class="dropdown-list">
                                                <li><a href="{{URL::to('/login_home')}}">Đăng Nhập</a></li>
                                                <li><a href="{{URL::to('/register_home')}}">Đăng Ký</a></li>
                                                <?php
                                                $name_user= Session::get('user_name');
                                                if($name_user){
                                                ?>
                                                <li><a href="{{URL::to('/my_account')}}">Tài Khoản Của Tôi</a></li>
                                                <li><a href="{{URL::to('/show_order')}}">Đơn Hàng</a></li>
                                                <li><a href="{{URL::to('/logout_user')}}">Đăng Xuất</a></li>
                                                <?php
                                                }
                                                ?> 
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{URL::to('/wish_list')}}">
                                                <i class="lnr lnr-heart"></i>
                                                <div class="notification" id="count_wishlist">
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="minicart-btn">
                                                <i class="lnr lnr-cart"></i>
                                                <div class="notification" id="minicart">
                                                    <?php 
                                                        $cart=Session::get('cart');
                                                        if ($cart) {
                                                           echo count($cart);
                                                        }else{
                                                           echo 0;
                                                        }
                                                    ?>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->
                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->

        <!-- mobile header start -->
        <div class="mobile-header d-lg-none d-md-block sticky">
            <!--mobile header top start -->
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="{{URL::to('/trang_chu')}}">
                                    <img src="{{asset('public/frontend/assets/img/logo_brand.png')}}" alt="Brand Logo">
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <div class="mini-cart-wrap">
                                    <a href="cart.html">
                                        <i class="lnr lnr-cart"></i>
                                    </a>
                                </div>
                                <div class="mobile-menu-btn">
                                    <div class="off-canvas-btn">
                                        <i class="lnr lnr-menu"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile header top start -->
        </div>
        <!-- mobile header end -->
    </header>
    <!-- end Header Area -->

    <!-- off-canvas menu start -->
    <aside class="off-canvas-wrapper">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas">
                <i class="lnr lnr-cross"></i>
            </div>

            <div class="off-canvas-inner">
                <!-- search box start -->
                <div class="search-box-offcanvas">
                    <form method="get" action="{{URL::to('/search')}}">
                        {{csrf_field()}}
                        <input type="text" placeholder="Tìm Kiếm..." name="key_words">
                        <button class="search-btn"><i class="lnr lnr-magnifier"></i></button>
                    </form>
                </div>
                <!-- search box end -->

                <!-- mobile menu start -->
                <div class="mobile-navigation">

                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="{{URL::to('/trang_chu')}}">Trang Chủ</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Home version 01</a></li>
                                    <li><a href="index-2.html">Home version 02</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children"><a href="#">Sản Phẩm</a>
                                <ul class="megamenu dropdown">
                                    <li class="mega-title menu-item-has-children"><a href="#">Danh Mục</a>
                                        <ul class="dropdown">
                                            @foreach($category as $key => $value_cate)
                                            <li>
                                                <a href="">{{$value_cate->TenLoaiHang}}</a>
                                            </li>
                                            @endforeach
                                            
                                        </ul>
                                    </li>
                                    <li class="mega-title menu-item-has-children"><a href="#">Nhà Sản Xuất</a>
                                        <ul class="dropdown">
                                            @foreach($producer as $key => $value_pro)   
                                            <li><a href="">{{$value_pro->TenNSX}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="#">Tin Tức</a>
                                <ul class="dropdown">
                                    <li><a href="blog-left-sidebar.html">blog left sidebar</a></li>
                                    <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                                    <li><a href="blog-grid-full-width.html">blog grid no sidebar</a></li>
                                    <li><a href="blog-details.html">blog details</a></li>
                                    <li><a href="blog-details-left-sidebar.html">blog details left sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="contact-us.html">Liên Hệ</a></li>
                            <li><a href="contact-us.html">Giới Thiệu</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->

                <div class="mobile-settings">
                    <ul class="nav">
                        <li>
                            <div class="dropdown mobile-top-dropdown">
                                <a href="#" class="dropdown-toggle" id="currency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Đơn Vị Tiền Tệ
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="currency">
                                    <a class="dropdown-item" href="#">đ VND</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown mobile-top-dropdown">
                                <a href="#" class="dropdown-toggle" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tài Khoản
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="myaccount">
                                    <a class="dropdown-item" href="my-account.html">Tài Khoản Của Tôi</a>
                                    <a class="dropdown-item" href="{{URL::to('/register_home')}}"> Đăng Nhập</a>
                                    <a class="dropdown-item" href="">Đăng Xuất</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- offcanvas widget area start -->
                <div class="offcanvas-widget-area">
                    <div class="off-canvas-contact-widget">
                        <ul>
                            <li><i class="fa fa-mobile"></i>
                                <a href="#">0123456789</a>
                            </li>
                            <li><i class="fa fa-envelope-o"></i>
                                <a href="#">info@yourdomain.com</a>
                            </li>
                        </ul>
                    </div>
                    <div class="off-canvas-social-widget">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
                <!-- offcanvas widget area end -->
            </div>
        </div>
    </aside>
    <!-- off-canvas menu end -->



    <!-- main wrapper start -->
    
    @yield('contend')
    
    <!-- main wrapper end -->

    <!-- Start Footer Area Wrapper -->
    <footer class="footer-wrapper">

        <!-- footer widget area start -->
        <div class="footer-widget-area">
            <div class="container">
                <div class="footer-widget-inner section-space">
                    <div class="row mbn-30">
                        <!-- footer widget item start -->
                        <div class="col-lg-5 col-md-6 col-sm-8">
                            <div class="footer-widget-item mb-30">
                                <div class="footer-widget-title">
                                    <h5>My account</h5>
                                </div>
                                <ul class="footer-widget-body accout-widget">
                                    <li class="address">
                                        <em><i class="lnr lnr-map-marker"></i></em>
                                        184 Main Rd E, St Albans VIC 3021, Australia
                                    </li>
                                    <li class="email">
                                        <em><i class="lnr lnr-envelope"></i>Mail us: </em>
                                        <a href="mailto:test@yourdomain.com">yourmail@gmail.com</a>
                                    </li>
                                    <li class="phone">
                                        <em><i class="lnr lnr-phone-handset"></i> Phones: </em>
                                        <a href="tel:(012)800456789-987">(012) 800 456 789-987</a>
                                    </li>
                                </ul>
                                <div class="payment-method">
                                    <img src="{{asset('public/frontend/assets/img/payment-pic.png')}}" alt="payment method">
                                </div>
                            </div>
                        </div>
                        <!-- footer widget item end -->

                        <!-- footer widget item start -->
                        <div class="col-lg-2 col-md-6 col-sm-4">
                            <div class="footer-widget-item mb-30">
                                <div class="footer-widget-title">
                                    <h5>categories</h5>
                                </div>
                                <ul class="footer-widget-body">
                                    <li><a href="#">Ecommerce</a></li>
                                    <li><a href="#">shopify</a></li>
                                    <li><a href="#">Prestashop</a></li>
                                    <li><a href="#">Opencart</a></li>
                                    <li><a href="#">Magento</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- footer widget item end -->

                        <!-- footer widget item start -->
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="footer-widget-item mb-30">
                                <div class="footer-widget-title">
                                    <h5>information</h5>
                                </div>
                                <ul class="footer-widget-body">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Exchanges</a></li>
                                    <li><a href="#">Shipping</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- footer widget item end -->

                        <!-- footer widget item start -->
                        <div class="col-lg-2 offset-lg-1 col-md-6 col-sm-6">
                            <div class="footer-widget-item mb-30">
                                <div class="footer-widget-title">
                                    <h5>Quick Links</h5>
                                </div>
                                <ul class="footer-widget-body">
                                    <li><a href="#">Store Location</a></li>
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Orders Tracking</a></li>
                                    <li><a href="#">Size Guide</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- footer widget item end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- footer widget area end -->

        <!-- footer bottom area start -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 order-2 order-md-1">
                        <div class="copyright-text">
                            <p>Copyright ©All Right Reserved.</p>
                        </div>
                    </div>
                    <div class="col-md-6 order-1 order-md-2">
                        <div class="footer-social-link">
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer bottom area end -->

    </footer>
    <!-- End Footer Area Wrapper -->

    <!-- Quick view modal start -->
    <div class="modal" id="quick_view">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom" id="product-image">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7">
                                <div class="product-details-des quick-details">
                                    <h3 class="product-name" id="product-name"></h3>
                                    <div class="ratings d-flex" >
                                        <div id="product-rating">
                                            
                                        </div>
                                        <div class="pro-review" id="product-review">
                                            
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <span class="price-regular" id="product-price"></span>
                                        {{-- <span class="price-old"><del>$90.00</del></span> --}}
                                    </div>
                                    <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                                    <div class="product-countdown" data-countdown="2021/12/25"></div>
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span id="product-qty"></span> in stock
                                    </div>
                                    <p class="pro-desc" id="product-desc">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                                    eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <h5>qty:</h5>
                                        <div class="quantity">
                                            <div class="pro-qty"><input type="text" value="1"></div>
                                        </div>
                                        <div class="action_link">
                                            <a class="btn btn-cart2" href="#">Add to cart</a>
                                        </div>
                                    </div>
                                    <div class="useful-links">
                                        <a href="#" data-toggle="tooltip" title="Compare"><i
                                            class="lnr lnr-sync"></i>compare</a>
                                            <a href="#" data-toggle="tooltip" title="Wishlist"><i
                                                class="lnr lnr-heart"></i>wishlist</a>
                                            </div>
                                            <div class="like-icon">
                                                <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                                <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                                <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                                <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- product details inner end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick view modal end -->

            <!-- offcanvas search form start -->
            <div class="offcanvas-search-wrapper">
                <div class="offcanvas-search-inner">
                    <div class="offcanvas-close">
                        <i class="lnr lnr-cross"></i>
                    </div>
                    <div class="container">
                        <div class="offcanvas-search-box">
                            <form class="d-flex bdr-bottom w-100" method="get" action="{{URL::to('/search')}}">
                                {{csrf_field()}}
                                <input type="text" placeholder="Tìm kiếm sản phẩm" name="key_words" >
                                <button class="search-btn search"><i class="lnr lnr-magnifier"></i>search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- offcanvas search form end -->

            <!-- offcanvas mini cart start -->
            <div class="offcanvas-minicart-wrapper">
                <div class="minicart-inner">
                    <div class="offcanvas-overlay"></div>
                    <div class="minicart-inner-content">
                        <div class="minicart-close">
                            <i class="lnr lnr-cross"></i>
                        </div>
                        @php
                        $total=0;
                        @endphp    

                        <div class="minicart-content-box" id="minicart_cnt">

                        </div>
                    </div>
                </div>
            </div>
            <!-- offcanvas mini cart end -->

            <!-- Scroll to top start -->
            <div class="scroll-top not-visible">
                <i class="fa fa-angle-up"></i>
            </div>
            <!-- Scroll to Top End -->

            <!-- All vendor & plugins & active js include here -->
            <!--All Vendor Js -->
            <script src="{{asset('public/frontend/assets/js/vendor.js')}}"></script>
            <!-- Active Js -->
            <script src="{{asset('public/frontend/assets/js/active.js')}}"></script>
            
            <script src="{{asset('public/frontend/assets/js/sweetalert.min.js')}}"></script>

            <script src="{{asset('public/frontend/assets/js/jquery.validate.min.js')}}"></script>
            <script type="text/javascript">
                //Thêm giỏ hàng bằng AJAX
                $(document).ready(function(){
                    load_minicart();
                    load_wishlist();

                    function load_minicart(){
                        $.ajax({
                            url: '{{url('/show_mini_cart')}}',
                            method: "GET",
                            data:{},
                            success:function(data){
                                $('#minicart_cnt').html(data);
                            }
                        });
                    }
                    function load_wishlist(){
                        $.ajax({
                            url: '{{url('/count_wishlist')}}',
                            method: "GET",
                            data:{},
                            success:function(data){
                                $('#count_wishlist').html(data);
                            }
                        });
                    }
                    
                    $('.add_cart').click(function(){
                        var id = $(this).data('id');
                        var cart_product_id = $('.cart_product_id_' + id).val();
                        var cart_product_name = $('.cart_product_name_' + id).val();
                        var cart_product_image = $('.cart_product_image_' + id).val();
                        var cart_product_price = $('.cart_product_price_' + id).val();
                        var cart_product_qty = $('.cart_product_qty_' + id).val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/add_cart_ajax')}}',
                            method: 'POST',
                            dataType: 'JSON',
                            data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                            success:function(data){
                                if(data.error==0){
                                    $('#minicart').html(data.count);
                                    load_minicart();
                                    swal({
                                        title: "Thêm vào giỏ hàng thành công",
                                        icon: "success",
                                        button: "OK",
                                    });
                                }else{
                                    swal({
                                      title: "Số lượng tồn không đủ",
                                      icon: "warning",
                                      button: "OK",
                                    });
                                }
                            }
                        });
                    });
                });
                //Quick view
                $('.quick_view').click(function(){
                    var id_product = $(this).data('id_product');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: '{{url('/quickview')}}',
                        method: "POST",
                        dataType: "JSON",
                        data:{id_product:id_product,_token:_token},
                        success:function(data){
                            $('#product-name').html(data.TenHH);
                            $('#product-image').html(data.hinhanh1);
                            $('#product-desc').html(data.MoTa);
                            $('#product-qty').html(data.SoLuongHang);
                            $('#product-price').html(data.Gia);
                            $('#product-review').html(data.review);
                            $('#product-rating').html(data.rating);
                        }
                    });
                });
                //Thêm sản phẩm yêu thích
                $('.add_favourite').click(function(){
                    var id_product = $(this).data('id_product');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: '{{url('/favourite_product')}}',
                        method: "POST",
                        dataType: "JSON",
                        data:{id_product:id_product,_token:_token},
                        success:function(data){
                            if(data.status==1){
                                $('#count_wishlist').html(data.count);
                            }else if(data.status==2){
                                swal({
                                  title: "Sản phẩm đã được thêm",
                                  icon: "warning",
                                  button: "OK",
                                });
                            }else{
                                swal({
                                  title: "Bạn chưa đăng nhập",
                                  icon: "warning",
                                  button: "OK",
                                });
                            }
                        }
                    });
                });
                //Xoá khỏi sp yêu thích
                $('.del_wishlist').click(function(){
                    var id = $(this).data('id_product');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: '{{url('/delete_wishlist')}}',
                        method: "POST",
                        data:{Ma:id,_token:_token},
                        success:function(data){
                            location.reload();
                        }
                    });
                });
                //Thêm bình luận
                $(document).ready(function(){
                    load_comment();

                    function load_comment(){
                        var id_product = $('.comment_pro_id').val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: '{{url('/load_comment')}}',
                            method: "POST",
                            data:{id_product:id_product,_token:_token},
                            success:function(data){
                                $('#total-reviews').html(data);
                            }
                        });
                    }
                    $('.cmt_add').click(function(){
                        var id_product = $('.cmt_pro_id').val();
                        var content = $('.cmt_content').val();
                        var _token = $('input[name="_token"]').val();
                        var rating = $('input[name="star"]:checked').val();
                        $.ajax({
                            url: '{{url('/add_comment')}}',
                            method: "POST",
                            data:{
                                id_product:id_product,
                                _token:_token,
                                content:content,
                                rating: rating},
                            success:function(data){
                                load_comment();
                            },error: function() {
                               swal({
                                  title: "Bạn Chưa Đăng Nhập",
                                  icon: "warning",
                                  button: "OK",
                                });
                            }
                        });
                    });
                    $('#sort_by').on('change', function(){  
                        var url = $(this).val();
                        if(url){
                            window.location= url;
                        }
                        return false;
                    });
                });
            </script>
        </body>

        </html>