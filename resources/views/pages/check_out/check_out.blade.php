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
                                <h1>THANH TOÁN</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Thanh Toán</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-space pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php
                            $user_id=Session::get('user_id');
                            if($user_id==null){
                        ?>
                        <!-- Checkout Login Coupon Accordion Start -->
                        <div class="checkoutaccordion" id="checkOutAccordion">
                            <div class="card">
                                <h3>
                                    <span><a href="{{URL::to('/login_home')}}">Đăng nhập để có thể thanh toán </a></span>
                                </h3>
                            </div>

                            <div class="card">
                                <h3>
                                    <span data-toggle="collapse" data-target="#couponaccordion">
                                        Nhấn vào đây để thêm voucher
                                    </span>
                                </h3>
                                <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                    <div class="card-body">
                                        <div class="cart-update-option">
                                            <div class="apply-coupon-wrapper">
                                                <form action="#" method="post" class=" d-block d-md-flex">
                                                    <input type="text" placeholder="Enter Your Coupon Code" required />
                                                    <button class="btn btn__bg">Apply Coupon</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Checkout Login Coupon Accordion End -->
                        <?php
                            }
                        ?>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h2>THÔNG TIN ĐƠN HÀNG</h2>
                            @if(session('notice'))
                            <p style="color: black; text-align: center;">
                                {{session('notice')}}
                            </p>
                            @endif
                            <div class="billing-form-wrap">
                                <form action="{{URL::to('/save_check_out')}}" method="post">
                                    {{csrf_field()}}
                                    <label >Địa Chỉ Nhận Hàng</label>
                                    <div class="order-payment-method">
                                        @foreach($all_address_by_id as $key => $val)
                                        <div class="single-payment-method show">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cashon[{{$val->MaDC}}]" name="DiaChi" value="{{$val->MaDC}}" class="custom-control-input" required />
                                                    <label class="custom-control-label" for="cashon[{{$val->MaDC}}]">
                                                        {{$val->HoTen . " " . $val->SDT . " - " .$val->DiaChi}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="single-payment-method">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <label class="custom-control-label"><a href="" data-toggle="modal" data-target="#quick_view">Thêm Địa Chỉ Nhận Hàng</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="ordernote">Ghi Chú</label>
                                        <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder=""></textarea>
                                    </div>

                                    <div class="order-payment-method">
                                        <div class="single-payment-method show">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cashon" name="paymentmethod" value="cash" class="custom-control-input" checked />
                                                    <label class="custom-control-label" for="cashon">Thanh Toán Khi Nhận Hàng</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-payment-method">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="paypalpayment" name="paymentmethod" value="paypal" class="custom-control-input" />
                                                    <label class="custom-control-label" for="paypalpayment">Paypal <img src="{{asset('public/frontend/assets/img/paypal-card.jpg')}}" class="img-fluid paypal-card" alt="Paypal" /></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required name="check" value="1" />
                                            <label class="custom-control-label" for="terms">Tôi đồng ý với các <a href="{{URL::to('/trang_chu')}}">điều khoản.</a></label>
                                        </div>
                                        <input type="submit" name="XacNhan" class="btn btn__bg" value="Xác Nhận">
                                    </div>
                                </form>    
                            </div>
                        </div>
                    </div>

                        <!-- Order Summary Details -->
                        <div class="col-lg-6">
                            <div class="order-summary-details">
                                <h2>SẢN PHẨM</h2>
                                <div class="order-summary-content">
                                    <?php
                                    $content =  Session::get('cart');
                                    $total=0;
                                    ?>
                                 <!-- Order Summary Table -->
                                 <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><strong>Sản phẩm</strong></th>
                                                <th><strong>Tổng Cộng</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($content as $value) 
                                            @php
                                            $total=$total+ $value['product_price']*$value['product_qty'];
                                            @endphp
                                            <tr>
                                                <td>
                                                	<a href="">{{$value['product_name']}} <strong> × {{$value['product_qty']}}</strong>
                                                	</a>
                                                </td>
                                                <td>{{number_format($value['product_qty']*$value['product_price'] , 0, ',', ' ').'đ';}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Tổng Tiền Hàng</td>
                                                <td>{{number_format($total , 0, ',', ' ').'đ';}}</td>
                                            </tr>
                                            <tr>
                                                <td>Phí Vận Chuyển</td>
                                                <td>
                                                    @php
                                                    if($total>=1000000){
                                                        echo 'Free';
                                                    }else{
                                                        $total=$total+30000;
                                                        echo number_format(30000 , 0, ',', ' ').'đ';
                                                    }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tổng Thanh Toán</td>
                                                <td>{{number_format($total , 0, ',', ' ').'đ';}}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                
                            </div>
                        </div>
                    </div>{{-- end row --}}
                </div>
            </div>
        </div>
        <!-- checkout main wrapper end -->

        <!-- Quick view modal start -->
        <div class="modal" id="quick_view">
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
                                    <h3 style="text-align: center;">THÊM ĐỊA CHỈ NHẬN HÀNG</h3>
                                    <form action="{{URL::to('/shipping_add')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="single-input-item">
                                            <input type="text" name="HoTen" placeholder="Họ và tên" required />
                                        </div>

                                        <div class="single-input-item">
                                            <input type="text" name="SDT" placeholder="Số điện thoại" required />
                                        </div>

                                        <div class="single-input-item">
                                            <input type="text" name="DiaChi" placeholder="Địa chỉ cụ thế" required />
                                        </div>

                                        <div class="single-input-item">
                                            <input type="submit" name="ThemDC" class="btn btn__bg" value="Hoàn Thành">
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

@endsection