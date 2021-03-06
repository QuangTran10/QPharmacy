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

    <link href="{{asset('public/frontend/assets/css/upload.css')}}" rel="stylesheet">

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
                                <p>Ch??o m???ng 
                                <b>
                                    <?php
                                    $name_user= Session::get('user_name');
                                    if($name_user){
                                        echo $name_user;
                                    }
                                    ?>
                                </b> 
                                ?????n QPharmacy</p>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="header-top-settings">
                                <ul class="nav align-items-center justify-content-end">
                                    <li class="language">
                                        <span>Ng??n Ng???</span>
                                        <img src="{{asset('public/frontend/assets/img/icon/vn.png')}}" alt="flag"> Vi???t Nam
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="dropdown-list">
                                            <li><a href="#"><img src="{{asset('public/frontend/assets/img/icon/vn.png')}}" alt="flag"> Vi???t Nam</a></li>
                                        </ul>
                                    </li>
                                    <li class="curreny-wrap">
                                        <span>????n V??? Ti???n T???</span>
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
                                            <li class="active"><a href="{{URL::to('/trang_chu')}}">Trang Ch???</a></li>
                                            <li class="static"><a href="#">S???n Ph???m <i class="fa fa-angle-down"></i></a>
                                                <ul class="megamenu dropdown">
                                                    <li class="mega-title"><a href="#">Danh M???c</a>
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
                                                    <li class="mega-title"><a href="#">Nh?? S???n Xu???t</a>
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
                                            <li><a href="{{URL::to('/contact_us')}}">Li??n H???</a></li>
                                            <li><a href="{{URL::to('/contact_us')}}">Gi???i Thi???u</a></li>
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
                                                <?php
                                                $name_user= Session::get('user_name');
                                                ?>
                                                @if($name_user)
                                                <li><a href="{{URL::to('/my_account')}}">T??i Kho???n C???a T??i</a></li>
                                                <li><a href="{{URL::to('/show_order')}}">????n H??ng</a></li>
                                                <li><a href="{{URL::to('/logout_user')}}">????ng Xu???t</a></li>
                                                @else
                                                <li><a href="{{URL::to('/login_home')}}">????ng Nh???p</a></li>
                                                <li><a href="{{URL::to('/register_home')}}">????ng K??</a></li>
                                                @endif
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
                                    <a href="{{URL::to('/cart_shopping')}}">
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
                        <input type="text" placeholder="T??m Ki???m..." name="key_words">
                        <button class="search-btn"><i class="lnr lnr-magnifier"></i></button>
                    </form>
                </div>
                <!-- search box end -->

                <!-- mobile menu start -->
                <div class="mobile-navigation">

                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="{{URL::to('/trang_chu')}}">Trang Ch???</a>
                            </li>
                            <li class="menu-item-has-children"><a href="#">S???n Ph???m</a>
                                <ul class="megamenu dropdown">
                                    <li class="mega-title menu-item-has-children"><a href="#">Danh M???c</a>
                                        <ul class="dropdown">
                                            @foreach($category as $key => $value_cate)
                                            <li>
                                                <a href="">{{$value_cate->TenLoaiHang}}</a>
                                            </li>
                                            @endforeach
                                            
                                        </ul>
                                    </li>
                                    <li class="mega-title menu-item-has-children"><a href="#">Nh?? S???n Xu???t</a>
                                        <ul class="dropdown">
                                            @foreach($producer as $key => $value_pro)   
                                            <li><a href="">{{$value_pro->TenNSX}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{URL::to('/contact_us')}}">Li??n H???</a></li>
                            <li><a href="{{URL::to('/contact_us')}}">Gi???i Thi???u</a></li>
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
                                    ????n V??? Ti???n T???
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="currency">
                                    <a class="dropdown-item" href="#">?? VND</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown mobile-top-dropdown">
                                <a href="#" class="dropdown-toggle" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    T??i Kho???n
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="myaccount">
                                    <a class="dropdown-item" href="my-account.html">T??i Kho???n C???a T??i</a>
                                    <a class="dropdown-item" href="{{URL::to('/register_home')}}"> ????ng Nh???p</a>
                                    <a class="dropdown-item" href="">????ng Xu???t</a>
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
                                <a href="tel:0859083181">(+84) 859083182</a>
                            </li>
                            <li><i class="fa fa-envelope-o"></i>
                                <a href="mailto:qtran8219@gmail.com">qtran8219@gmail.com</a>
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
                                    <h5>QPharmacy</h5>
                                </div>
                                <ul class="footer-widget-body accout-widget">
                                    <li class="address">
                                        <em><i class="lnr lnr-map-marker"></i></em>
                                        27 Hai B?? Tr??ng, Ph?????ng 3, Th??nh ph??? S??c Tr??ng 
                                    </li>
                                    <li class="email">
                                        <em><i class="lnr lnr-envelope"></i>Email: </em>
                                        <a href="mailto:qtran8219@gmail.com">qtran8219@gmail.com</a>
                                    </li>
                                    <li class="phone">
                                        <em><i class="lnr lnr-phone-handset"></i> S??? ??i???n Tho???i: </em>
                                        <a href="tel:0859083181">(+84) 859083182 </a>
                                    </li>
                                </ul>
                                <div class="payment-method">
                                    <img src="{{asset('public/frontend/assets/img/payment-pic.png')}}" alt="payment method">
                                </div>
                            </div>
                        </div>
                        <!-- footer widget item end -->

                        <!-- footer widget item start -->
                        <div class="col-lg-3 col-md-6 col-sm-4">
                            <div class="footer-widget-item mb-30">
                                <div class="footer-widget-title">
                                    <h5>Danh M???c</h5>
                                </div>
                                <ul class="footer-widget-body">
                                    @foreach($category as $key => $value_cate)
                                    @if($value_cate->MaLoaiHang %2 ==0)    
                                    <li>
                                        <a href="{{URL::to('/category_home/'.$value_cate->MaLoaiHang)}}">{{$value_cate->TenLoaiHang}}</a>
                                    </li>
                                    @endif
                                    @endforeach   
                                </ul>
                            </div>
                        </div>
                        <!-- footer widget item end -->

                        <!-- footer widget item start -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="footer-widget-item mb-30">
                                <div class="footer-widget-title">
                                    <h5></h5>
                                </div>
                                <ul class="footer-widget-body">
                                    @foreach($category as $key => $value_cate)    
                                    @if($value_cate->MaLoaiHang %2 !=0)    
                                    <li>
                                        <a href="{{URL::to('/category_home/'.$value_cate->MaLoaiHang)}}">{{$value_cate->TenLoaiHang}}</a>
                                    </li>
                                    @endif
                                    @endforeach
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
                            <p>Copyright ??All Right Reserved.</p>
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
                                    <div class="pro-large-img img-zoom" id="product-image"></div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7">
                                <div class="product-details-des quick-details">
                                    <h3 class="product-name" id="product-name"></h3>
                                    <div class="ratings d-flex" >
                                        <div id="product-rating"></div>
                                        <div class="pro-review" id="product-review"></div>
                                    </div>
                                    <div class="price-box">
                                        <span class="price-regular" id="product-price"></span>
                                    </div>
                                    
                                    <div class="product-countdown" data-countdown="2021/12/25"></div>
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span id="product-qty"></span> trong kho
                                    </div>
                                    <p class="pro-desc" id="product-desc"></p>
                                    <div class="useful-links">
                                        <a href="#" data-toggle="tooltip" title="Wishlist"><i
                                            class="lnr lnr-heart"></i>Y??u Th??ch
                                        </a>
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
                                <input type="text" placeholder="T??m ki???m s???n ph???m" name="key_words" >
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
                        <div class="minicart-content-box" id="minicart_cnt"></div>
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
            <script src="{{asset('public/frontend/assets/js/upload.js')}}"></script>

            <script src="{{asset('public/frontend/assets/js/vendor.js')}}"></script>
            <!-- Active Js -->
            <script src="{{asset('public/frontend/assets/js/active.js')}}"></script>
            
            <script src="{{asset('public/frontend/assets/js/sweetalert.min.js')}}"></script>

            <script src="{{asset('public/frontend/assets/js/jquery.validate.min.js')}}"></script>
            <script type="text/javascript">
                //Th??m gi??? h??ng b???ng AJAX
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
                    //?????m c??c sp trong y??u th??ch
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
                    //Th??m v??o gi??? h??ng
                    $('.add_cart').click(function(){
                        var id = $(this).data('id');
                        var cart_product_id = $('.cart_product_id_' + id).val();
                        var cart_product_name = $('.cart_product_name_' + id).val();
                        var cart_product_image = $('.cart_product_image_' + id).val();
                        var cart_product_price = $('.cart_product_price_' + id).val();
                        var cart_product_qty = $('.cart_product_qty_' + id).val();
                        var cart_product_discount = $('.cart_product_discount_' + id).val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/add_cart_ajax')}}',
                            method: 'POST',
                            dataType: 'JSON',
                            data:{cart_product_id:cart_product_id,
                                cart_product_name:cart_product_name,
                                cart_product_image:cart_product_image,
                                cart_product_price:cart_product_price,
                                cart_product_qty:cart_product_qty,
                                cart_product_discount:cart_product_discount,
                                _token:_token},
                            success:function(data){
                                if(data.error==0){
                                    $('#minicart').html(data.count);
                                    load_minicart();
                                    swal({
                                        title: "Th??m v??o gi??? h??ng th??nh c??ng",
                                        icon: "success",
                                        button: "OK",
                                    });
                                }else{
                                    swal({
                                      title: "S??? l?????ng t???n kh??ng ?????",
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
                
                //Th??m s???n ph???m y??u th??ch
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
                                  title: "S???n ph???m ???? ???????c th??m",
                                  icon: "warning",
                                  button: "OK",
                                });
                            }else{
                                swal({
                                  title: "B???n ch??a ????ng nh???p",
                                  icon: "warning",
                                  button: "OK",
                                });
                            }
                        }
                    });
                });
                //Xo?? kh???i sp y??u th??ch
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
                //Th??m b??nh lu???n
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
                    //Th??m ????nh gi??
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
                                  title: "B???n Ch??a ????ng Nh???p",
                                  icon: "warning",
                                  button: "OK",
                                });
                            }
                        });
                    });
                    //L???c s???n ph???m
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