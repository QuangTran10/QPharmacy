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
                                <h1>YÊU THÍCH</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Yêu thích</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- wishlist main wrapper start -->
        <div class="wishlist-main-wrapper section-space pb-0">
            <div class="container">
                <!-- Wishlist Page Content Start -->
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Wishlist Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table">
                                    <tbody>
                                    	<?php $MSKH=Session::get('user_id'); ?>
                                    	@if($MSKH)
                                    	@foreach($all_wish_list as $key => $value)
                                    	<tr>
                                    		<td class="pro-thumbnail">
                                    			<a href="#"><img class="img-fluid" src="{{asset('public/upload/'.$value->hinhanh1)}}" alt="Product" /></a>
                                    		</td>
                                    		<td class="pro-title">
                                    			<a href="#">{{$value->TenHH}}</a>
                                    		</td>
                                    		<td class="pro-price">
                                    			<span>{{number_format($value->Gia, 0, ',', ' ').'đ';}}</span>
                                    		</td>
                                    		<td class="pro-quantity">
                                    			@if($value->SoLuongHang >0)
												<span class="text-success">Còn Hàng</span>
                                    			@else
												<span class="text-danger">Hết Hàng</span>
                                    			@endif
                                    		</td>
                                    		<td class="pro-subtotal">
                                    			<form>
                                    				{{csrf_field()}}
                                    				<input type="hidden" name="Id_{{$value->MSHH}}" value="{{$value->MSHH}}" class="cart_product_id_{{$value->MSHH}}">
                                    				<input type="hidden" name="Name" value="{{$value->TenHH}}" class="cart_product_name_{{$value->MSHH}}">
                                    				<input type="hidden" name="Image" value="{{$value->hinhanh1}}" class="cart_product_image_{{$value->MSHH}}">
                                    				<input type="hidden" name="Price" value="{{$value->Gia}}" class="cart_product_price_{{$value->MSHH}}">
                                    				<input type="hidden" name="SoLuong" value="1" class="cart_product_qty_{{$value->MSHH}}">  
                                    			</form>
                                    			<button><a href="" data-id="{{$value->MSHH}}" class="btn btn__bg add_cart">Thêm Giỏ Hàng</a></button>
                                    		</td>
                                    		<td class="pro-remove">
                                    			<form>
                                    				@csrf
                                    				<button class="del_wishlist" data-id_product={{$value->Ma}}><a href="#"><i class="fa fa-trash-o"></i></a></button>
                                    			</form>
                                    			
                                    		</td>
                                    	</tr>
                                    	@endforeach
                                    	@else
                                    	<tr>
                                    		<td colspan="6">BẠN CHƯA ĐĂNG NHẬP</td>
                                    	</tr>
                                    	@endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Wishlist Page Content End -->
            </div>
        </div>
        <!-- wishlist main wrapper end -->
    </main>
    <!-- main wrapper end -->

@endsection