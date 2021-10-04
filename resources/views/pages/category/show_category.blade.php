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
                            <h1>SẢN PHẨM</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-space pb-0">
        <div class="container">
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h3 class="sidebar-title">Danh Mục</h3>
                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                @foreach($category as $key => $value_cate)    
                                <li>
                                    <a href="{{URL::to('/category_home/'.$value_cate->MaLoaiHang)}}">{{$value_cate->TenLoaiHang}}</a>
                                </li>
                                @endforeach    
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->


                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h3 class="sidebar-title">Nhà Sản Xuất</h3>
                            <div class="sidebar-body">
                                <ul class="checkbox-container categories-list">
                                    
                                    @foreach($producer as $key => $value_pro)   
                                    {{-- <li><a href=""></a></li> --}}
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">
                                                <a href="{{URL::to('/producer_home/'.$value_pro->MaNSX)}}">{{$value_pro->TenNSX}}</a>
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <div class="sidebar-banner">
                            <div class="img-container">
                                <a href="#">
                                    <img src="{{asset('public/frontend/assets/img/banner/task2.jpg')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- single sidebar end -->
                    </aside>
                </div>
                <!-- sidebar area end -->

                <!-- shop main wrapper start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view" data-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view" data-toggle="tooltip" title="List View"><i class="fa fa-list"></i></a>
                                        </div>
                                        <div class="product-amount">
                                            <p>Hiển thị {{$soluong}} kết quả</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <div class="product-short">
                                            <p>Sắp Xếp Theo : </p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">--Chọn--</option>
                                                <option value="rating">Từ A - Z</option>
                                                <option value="date">Từ Z - A</option>
                                                <option value="price-asc">Giá: Thấp đến Cao</option>
                                                <option value="price-desc">Giá: Cao đến Thấp</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item list wrapper start -->
                        <div class="shop-product-wrap grid-view row mbn-40">
                            <!-- product single item start -->
                            @foreach($product as $key =>$value)
                            <div class="col-md-4 col-sm-6">
                                <!-- product grid start -->
                                <div class="product-item">
                                    <figure class="product-thumb">
                                        <a href="{{URL::to('/product_details/'.$value->MSHH)}}">
                                            <img class="pri-img" src="{{asset('public/upload/'.$value->hinhanh1)}}" alt="product">
                                            <img class="sec-img" src="{{asset('public/upload/'.$value->hinhanh1)}}" alt="product">
                                        </a>
                                        <div class="product-badge">
                                            <div class="product-label new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-label discount">
                                                <span>10%</span>
                                            </div>
                                            <form>
                                                {{csrf_field()}}
                                                <div class="quantity-cart-box d-flex align-items-center">
                                                    <input type="hidden" name="Id_{{$value->MSHH}}" value="{{$value->MSHH}}" class="cart_product_id_{{$value->MSHH}}">
                                                    <input type="hidden" name="Name" value="{{$value->TenHH}}" class="cart_product_name_{{$value->MSHH}}">
                                                    <input type="hidden" name="Image" value="{{$value->hinhanh1}}" class="cart_product_image_{{$value->MSHH}}">
                                                    <input type="hidden" name="Price" value="{{$value->Gia}}" class="cart_product_price_{{$value->MSHH}}">
                                                    <input type="hidden" name="SoLuong" value="1" class="cart_product_qty_{{$value->MSHH}}">
                                                </div>    
                                            </form>
                                        </div>
                                        <div class="button-group">
                                            <a href="#" class="add_favourite" data-toggle="tooltip" data-placement="left" data-id_product={{$value->MSHH}}><i class="lnr lnr-heart"></i></a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#quick_view" data-id_product={{$value->MSHH}}><span data-toggle="tooltip" data-placement="left" ><i class="lnr lnr-magnifier"></i></span></a>
                                            <button><a data-id="{{$value->MSHH}}" data-toggle="tooltip" data-placement="left" class="add_cart" ><i class="lnr lnr-cart"></i></a></button>
                                        </div>
                                    </figure>
                                    <div class="product-caption">
                                        <p class="product-name">
                                            <a href="{{URL::to('/product_details/'.$value->MSHH)}}">{{$value->TenHH}}</a>
                                        </p>
                                        <div class="price-box">
                                            <span class="price-regular">
                                                <?php
                                                $GiaSP = number_format($value->Gia, 0, ',', ' ');
                                                echo $GiaSP." đ";
                                                ?>
                                            </span>
                                            {{-- <span class="price-old"><del>$50.00</del></span> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- product grid end -->
                                <!-- product list item end -->
                                    <div class="product-list-item">
                                        <figure class="product-thumb">
                                            <a href="product-details.html">
                                                <img class="pri-img" src="{{asset('public/upload/'.$value->hinhanh1)}}" alt="product">
                                                <img class="sec-img" src="{{asset('public/upload/'.$value->hinhanh1)}}" alt="product">
                                            </a>
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-label discount">
                                                    <span>10%</span>
                                                </div>
                                            </div>
                                        </figure>
                                        <form>
                                            {{csrf_field()}}
                                            <div class="quantity-cart-box d-flex align-items-center">
                                                <input type="hidden" name="Id_{{$value->MSHH}}" value="{{$value->MSHH}}" class="cart_product_id_{{$value->MSHH}}">
                                                <input type="hidden" name="Name" value="{{$value->TenHH}}" class="cart_product_name_{{$value->MSHH}}">
                                                <input type="hidden" name="Image" value="{{$value->hinhanh1}}" class="cart_product_image_{{$value->MSHH}}">
                                                <input type="hidden" name="Price" value="{{$value->Gia}}" class="cart_product_price_{{$value->MSHH}}">
                                                <input type="hidden" name="SoLuong" value="1" class="cart_product_qty_{{$value->MSHH}}">
                                            </div>    
                                        </form>
                                        <div class="product-content-list">
                                            <h5 class="product-name"><a href="">{{$value->TenHH}}</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">
                                                    <?php
                                                    $GiaSP = number_format($value->Gia, 0, ',', ' ');
                                                    echo $GiaSP." đ";
                                                    ?>
                                                </span>
                                            </div>
                                            <p>{{$value->MoTa}}</p>
                                            <div class="button-group-list">
                                                <button><a class="btn-big" data-id="{{$value->MSHH}}" data-toggle="tooltip" class="add_cart" ><i class="lnr lnr-cart"></i>Thêm Vào Giỏ Hàng</a></button>
                                                <a href="#" data-toggle="modal" data-target="#quick_view"><span data-toggle="tooltip"  title="Xem"><i class="lnr lnr-magnifier"></i></span></a>
                                                <a href="" data-toggle="tooltip" title="Yêu Thích"><i class="lnr lnr-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product list item end -->
                            </div>
                            @endforeach
                        </div>

                        
                        {{-- <!-- start pagination area -->
                        <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <li><a class="previous" href="#"><i class="lnr lnr-chevron-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a class="next" href="#"><i class="lnr lnr-chevron-right"></i></a></li>
                            </ul>
                        </div>
                        <!-- end pagination area --> --}}
                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
</main>
    <!-- main wrapper end -->
@endsection    