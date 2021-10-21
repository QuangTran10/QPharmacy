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
                                <h1>Chi Tiết Sản Phẩm</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">chi tiết sản phẩm</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- page main wrapper start -->
        <div class="shop-main-wrapper section-space">
            <div class="container">
                <div class="row">
                    <!-- product details wrapper start -->
                    <div class="col-lg-12 order-1 order-lg-2">
                        <!-- product details inner end -->
                        <div class="product-details-inner">
                            <div class="row">
                            @foreach($product_detail as $key => $value_pro)	
                            @php
                                $MSHH=$value_pro->MSHH;
                                $MoTa=$value_pro->MoTa;
                            @endphp
                                <div class="col-lg-5">
                                    <div class="product-large-slider">
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{URL::to('public/upload/'.$value_pro->hinhanh1)}}" alt="product-details" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="product-details-des">
                                        <h3 class="product-name">{{$value_pro->TenHH}}
                                            @if($value_pro->GiamGia!=0)
                                            <span class="badge bg-warning text-dark">Giảm {{$value_pro->GiamGia*100}}%</span>
                                            @endif
                                            <?php
                                                if(isset($_GET['new'])){
                                                    echo '<span class="badge bg-danger">Mới</span>';
                                                }
                                            ?>
                                        </h3>

                                        <div class="ratings d-flex">

                                            @for ($i = 1; $i <= $Total; $i++)
                                            <span><i class="lnr lnr-star"></i></span>
                                            @endfor
                                            
                                            <div class="pro-review">
                                                <span>{{$count_reviews}} Đánh Giá</span>
                                            </div>
                                        </div>
                                        <div class="price-box">
                                            @if($value_pro->GiamGia!=0)    
                                            <span class="price-regular">
                                                <?php
                                                $GiaSP = number_format($value_pro->Gia*(1-$value_pro->GiamGia), 0, ',', ' ');
                                                echo $GiaSP." đ";
                                                ?>
                                            </span>
                                            <span class="price-old">
                                                <del>
                                                    <?php
                                                    $GiaSP = number_format($value_pro->Gia, 0, ',', ' ');
                                                    echo $GiaSP." đ";
                                                    ?>
                                                </del>
                                            </span>
                                            @else
                                            <span class="price-regular">
                                                <?php
                                                $GiaSP = number_format($value_pro->Gia, 0, ',', ' ');
                                                echo $GiaSP." đ";
                                                ?>
                                            </span>
                                            @endif 
                                        </div>
                                        <div class="product-countdown" data-countdown="2021/12/25"></div>
                                        <div class="availability">
                                            @if($value_pro->SoLuongHang==0)
                                                <span style="color: red;">HẾT HÀNG</span>
                                            @else
                                                <i class="fa fa-check-circle"></i>
                                                <span>{{$value_pro->SoLuongHang}} trong kho</span>
                                            @endif
                                        </div>
                                        {{-- <p class="pro-desc">
                                            
                                        </p> --}}
                                        <form>
                                            {{csrf_field()}}
                                            <input type="hidden" name="comment_pro_id" class="comment_pro_id" value="{{$value_pro->MSHH}}">
                                        </form>
                                       
                                        <form>
                                            {{csrf_field()}}
                                            <div class="quantity-cart-box d-flex align-items-center">
                                                <h5>Số Lượng:</h5>
                                                <input type="hidden" name="Id_{{$value_pro->MSHH}}" value="{{$value_pro->MSHH}}" class="cart_product_id_{{$value_pro->MSHH}}">
                                                <input type="hidden" name="Name" value="{{$value_pro->TenHH}}" class="cart_product_name_{{$value_pro->MSHH}}">
                                                <input type="hidden" name="Image" value="{{$value_pro->hinhanh1}}" class="cart_product_image_{{$value_pro->MSHH}}">
                                                <input type="hidden" name="Price" value="{{$value_pro->Gia}}" class="cart_product_price_{{$value_pro->MSHH}}">
                                                <input type="hidden" name="Discount" value="{{$value_pro->GiamGia}}" class="cart_product_discount_{{$value_pro->MSHH}}">
                                                <div class="quantity">
                                                    <div class="pro-qty"><input type="text" value="1" min="1" name="SoLuong" class="cart_product_qty_{{$value_pro->MSHH}}"></div>
                                                </div>
                                                <div class="action_link">
                                                    <input data-id="{{$value_pro->MSHH}}" class="btn btn-cart2 add_cart" name="add_cart" value="Thêm Vào Giỏ Hàng" <?php if($value_pro->SoLuongHang==0) echo 'disabled="disabled"';?>>
                                                </div>
                                            </div>    
                                        </form>
                                        
                                        <div class="useful-links">
                                            <a href="#" data-toggle="tooltip" class="add_favourite"data-id_product={{$value_pro->MSHH}}>
                                                <i class="lnr lnr-heart"></i>Yêu Thích
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
                            @endforeach
                        </div>
                        <!-- product details inner end -->

                        <!-- product details reviews start -->
                        <div class="product-details-reviews section-space pb-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-review-info">
                                        <ul class="nav review-tab">
                                            <li>
                                                <a class="active" data-toggle="tab" href="#tab_one">Bình Luận</a>
                                            </li>
                                            <li>
                                                <a  data-toggle="tab" href="#tab_two">Mô Tả</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content reviews-tab">
                                            <div class="tab-pane fade show " id="tab_two">
                                                <div class="tab-one">
                                                    <p>
                                                    <?php 
                                                    echo $MoTa; 
                                                    ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade active" id="tab_one">
                                                <form action="#" class="review-form">
                                                    <div id="total-reviews">
                                                        
                                                    </div>
                                                    <form>
                                                        {{csrf_field()}}   
                                                        <input type="hidden" name="MSHH" value="{{$MSHH}}" class="cmt_pro_id">
                                                        <div class="form-group row">
                                                            <div class="col">
                                                                <label class="col-form-label"><span class="text-danger">*</span>
                                                                Nội Dung Bình Luận</label>
                                                                <textarea class="form-control cmt_content" id="cmt_content" required style="resize: none;"></textarea >
                                                                <div class="help-block pt-10"><span
                                                                    class="text-danger">Note:</span>
                                                                    HTML is not translated!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-1">
                                                                <label class="col-form-label"><span class="text-danger">*</span>
                                                                Đánh Giá</label>
                                                            </div>
                                                            <div class="col-md-5">
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
                                                            </div>
                                                        </div>
                                                        <div class="action_link">
                                                            <input class="btn btn-cart2 cmt_add" name="add_cart" value="Thêm Bình Luận" <?php
                                                            $user= Session::get('user_id');
                                                            if($user==NULL){
                                                                echo 'disable';
                                                            }
                                                            ?>>
                                                        </div>
                                                    </form>
                                                </form> <!-- end of review-form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product details reviews end -->
                    </div>
                    <!-- product details wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->

        <!-- related product area start -->
        <section class="related-products">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2>Sản Phẩm Liên Quan</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-carousel--4 slick-row-15 slick-sm-row-10 slick-arrow-style">
                            <!-- product single item start -->
                            @foreach($related_product as $key => $value)	
                            <div class="product-item">
                                <form>
                                {{csrf_field()}}  
                                <figure class="product-thumb">
                                    <a href="{{URL::to('/product_details/'.$value->MSHH)}}">
                                        <img class="pri-img" src="{{URL::to('public/upload/'.$value->hinhanh1)}}" alt="product">
                                        <img class="sec-img" src="{{URL::to('public/upload/'.$value->hinhanh1)}}" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        @if($value->GiamGia!=0)
                                        <div class="product-label discount">
                                            <span>{{$value->GiamGia*100}}%</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="button-group">
                                        <a href="#" class="add_favourite" data-toggle="tooltip" data-placement="left" data-id_product={{$value->MSHH}}><i class="lnr lnr-heart"></i></a>
                                        <a href="#" class="quick_view" data-toggle="modal" data-target="#quick_view" data-id_product={{$value->MSHH}}><span data-toggle="tooltip" data-placement="left" ><i class="lnr lnr-magnifier"></i></span></a>
                                        @if($value->SoLuongHang!=0)
                                        <button type="button" name="add_to_cart"><a href="" data-toggle="tooltip" data-placement="left" ><i class="lnr lnr-cart"></i></a></button>
                                        @endif
                                    </div>
                                </figure>
                                <div class="product-caption">
                                    <p class="product-name">
                                        <a href="{{URL::to('/product_details/'.$value->MSHH)}}">{{$value_pro->TenHH}}</a>
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
                                </form>
                            </div>
                            @endforeach
                            <!-- product single item end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- related product area end -->
    </main>
    <!-- main wrapper end -->

@endsection