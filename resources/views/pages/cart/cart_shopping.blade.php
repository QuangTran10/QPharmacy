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
                                <h1>Giỏ Hàng Của Bạn</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Giỏ Hàng</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-space pb-0">
            <div class="container">
                <div class="section-bg-color">
                    @if(session('notice'))
                    <h4 style="color: red;">{{session('notice')}}</h4>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <form action="{{URL::to('/update_cart')}}" method="post">
                                {{csrf_field() }}
                                <div class="cart-table table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="pro-thumbnail"></th>
                                                <th class="pro-title">Tên Sản Phẩm</th>
                                                <th class="pro-price">Giá</th>
                                                <th class="pro-price">Giảm Giá</th>
                                                <th class="pro-quantity">Số Lượng</th>
                                                <th class="pro-subtotal">Thành Tiền</th>
                                                <th class="pro-remove"></th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                        @php
                                            $total=0;
                                            $cart=Session::get('cart');
                                        @endphp

                                        @if($cart)        
                                            
                                            @foreach($cart as $key => $value)  
                                            @php
                                            $total=$total+ $value['product_price']*$value['product_qty']*(1-$value['product_discount']);
                                            @endphp
                                            <tr>
                                                <td class="pro-thumbnail">
                                                    <a href="">
                                                        <img class="img-fluid" src="{{URL::to('public/upload/'.$value['product_image'])}}" alt="Product" />
                                                    </a>
                                                </td>
                                                <td class="pro-title">{{$value['product_name']}}<a href=""></a></td>
                                                <td class="pro-price">
                                                    <span>
                                                        {{number_format($value['product_price'] , 0, ',', ' ').'đ';}}
                                                    </span>
                                                </td>
                                                <td class="pro-price">
                                                    <span>
                                                        {{$value['product_discount']*100}}%
                                                    </span>
                                                </td>
                                                <td class="pro-quantity">    
                                                    <div class="pro-qty">
                                                        <input type="text" value="{{$value['product_qty']}}" name="quantity[{{$value['session_id']}}]">
                                                    </div>   
                                                </td>
                                                <td class="pro-subtotal">
                                                    <span>
                                                        {{number_format($value['product_price']*$value['product_qty']*(1-$value['product_discount']) , 0, ',', ' ').'đ';}}
                                                    </span>
                                                </td>
                                                <td class="pro-remove" ><a href="{{URL::to('/delete_cart/'.$value['session_id'])}}"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                            @endforeach  
                                        @else
                                            <tr>
                                                <th colspan="6">Không có sản phẩm trong giỏ hàng</th>
                                            </tr>
                                        @endif      
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Cart Update Option -->
                                <div class="cart-update-option d-block d-md-flex justify-content-between">
                                    <div class="apply-coupon-wrapper">
                                        
                                    </div>
                                    <div class="cart-update">
                                        <button type="submit" class="btn btn__bg">Cập Nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h3>Thanh Toán</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Tổng Cộng</td>
                                                <td>{{number_format($total , 0, ',', ' ').'đ';}}</td>
                                            </tr>
                                            <tr>
                                                <td>Phí Vận Chuyển</td>
                                                <td>
                                                    @php
                                                    if($total>=1000000){
                                                        echo 'Free';
                                                    }elseif ($total==0) {
                                                        echo 0;
                                                    }
                                                    else{
                                                        $total=$total+30000;
                                                        echo number_format(30000 , 0, ',', ' ').'đ';
                                                    }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr class="total">
                                                <td>Thành Tiền</td>
                                                <td class="total-amount">
                                                    {{number_format($total , 0, ',', ' ').'đ';}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{URL::to('/check_out')}}" class="btn btn__bg d-block">THANH TOÁN</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{URL::to('/vnpay_check_out')}}" class="btn btn__bg d-block">THANH TOÁN VNPAY</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>
    <!-- main wrapper end -->

@endsection