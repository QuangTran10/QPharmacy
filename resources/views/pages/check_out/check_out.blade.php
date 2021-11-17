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
                                <h3>Bạn chưa Đăng nhập? <span data-toggle="collapse" data-target="#login">Đăng nhập để có thể thanh toán</span></h3>
                                <div id="login" class="collapse" data-parent="#checkOutAccordion">
                                    <div class="card-body">
                                        <p>Nếu bạn chưa đăng nhập bạn sẽ không thể tiến hành thanh toán đơn hàng của bạn. 
                                        Nếu chưa có tài khoản <a href="{{URL::to('/register_home')}}">Nhấn vào đây</a></p><br>
                                        Nếu đã có tài khoản hay đăng nhập tại đây.
                                        <div class="login-reg-form-wrap mt-20">
                                            <div class="row">
                                                <div class="col-lg-7 m-auto">
                                                    <form action="{{URL::to('/quick_login')}}" method="post">
                                                        {{ csrf_field() }}
                                                        @if(session('notice'))
                                                        <p style="color: red; text-align: center;">
                                                            {{session('notice')}}
                                                        </p>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="single-input-item">
                                                                    <input type="text" name="TaiKhoan" placeholder="Tài Khoản" required />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="single-input-item">
                                                                    <input type="password" name="MatKhau" placeholder="Mật Khẩu" required />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <button type="submit" class="btn btn__bg" name="DangNhap">Đăng Nhập</button>
                                                        </div>
                                                    </form>
                                                </div>
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
                                        @if($user_id!=null)
                                        <input type="submit" name="XacNhan" class="btn btn__bg" value="Xác Nhận">
                                        @endif
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
                                    $total_dis=0;
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
                                            $total=$total+ $value['product_price']*$value['product_qty']*(1-$value['product_discount']);
                                            $total_dis=$total_dis+ $value['product_price']*$value['product_qty']*($value['product_discount']);
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
                                                <td>Tổng Tiền Đã Giảm</td>
                                                <td>{{number_format($total_dis , 0, ',', ' ').'đ';}}</td>
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