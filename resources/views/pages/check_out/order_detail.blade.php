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
                                <h1>ĐƠN HÀNG</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{URL::to('/show_order')}}"><i class="fa fa-cart-arrow-down"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chi Tiết Đơn Hàng</li>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail"></th>
                                            <th class="pro-title">Tên Sản Phẩm</th>
                                            <th class="pro-price">Giá</th>
                                            <th class="pro-quantity">Số Lượng</th>
                                            <th class="pro-subtotal">Thành Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                        @php
                                        $total=0;
                                        @endphp
                                        @foreach($order_details as $key => $value)  
                                        @php
                                        $total=$total+ $value->SoLuong*$value->GiaDatHang;
                                        @endphp
                                        <tr>
                                            <td class="pro-thumbnail">
                                                <a href="">
                                                    <img class="img-fluid" src="{{URL::to('public/upload/'.$value->hinhanh1)}}" alt="Product" />
                                                </a>
                                            </td>
                                            <td class="pro-title">{{$value->TenHH}}<a href=""></a></td>
                                            <td class="pro-price">
                                                <span>
                                                    {{number_format($value->GiaDatHang , 0, ',', ' ').'đ';}}
                                                </span>
                                            </td>
                                            <td class="pro-price">
                                                <span>
                                                    {{$value->SoLuong}}
                                                </span>
                                            </td>
                                            <td class="pro-subtotal">
                                                <span>
                                                    {{number_format($value->SoLuong*$value->GiaDatHang , 0, ',', ' ').'đ';}}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach    
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            @if($order->TinhTrang==0)
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <form action="{{URL::to('/update_order')}}" method="post">
                                    {{csrf_field() }}
                                    <div class="cart-update">
                                        <input type="hidden" name="SoDonDH" value="{{$value->SoDonDH}}">
                                        <input type="hidden" name="TinhTrang" value="3">
                                        <button type="submit" class="btn btn__bg">Huỷ Đơn</button>
                                    </div>
                                </form>
                            </div>
                            @elseif($order->TinhTrang==1)
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <form action="{{URL::to('/update_order')}}" method="post">
                                    {{csrf_field() }}
                                    <div class="cart-update">
                                        <input type="hidden" name="SoDonDH" value="{{$value->SoDonDH}}">
                                        <input type="hidden" name="TinhTrang" value="2">
                                        <button type="submit" class="btn btn__bg">Đã Nhận Hàng</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr>
                                                <td>Tình Trạng Đơn Hàng</td>
                                                <td>
                                                    <?php
                                                    if($order->TinhTrang ==0)
                                                        echo '<p style="color:red">Đang Xử Lý...</p>';
                                                    elseif($order->TinhTrang ==1){
                                                        echo '<p style="color:red">Đang Giao Hàng</p>';
                                                    }elseif($order->TinhTrang ==2){
                                                        echo '<p style="color:green">Đã Giao Hàng</p>';
                                                    }else{
                                                        echo '<p>Đã Huỷ</p>';
                                                    } 
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Thanh Toán</td>
                                                <td>
                                                    <?php
                                                    if($order->TT_TrangThai ==0)
                                                        echo '<p style="color:red">Chưa Thanh Toán</p>';
                                                    elseif($order->TT_TrangThai ==1){
                                                        echo '<p style="color:green">Đã Thanh Toán</p>';
                                                    }else{
                                                        echo '<p style="color:green">Đã Thanh Toán VnPay</p>';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Thành Tiền</td>
                                                <td>{{number_format($total , 0, ',', ' ').'đ';}}</td>
                                            </tr>
                                            <tr>
                                                <td>Thông Tin Giao Hàng</td>
                                                <td>
                                                    {{$order->HoTen}}<br>
                                                    {{$order->SDT}}<br>
                                                    {{$order->DiaChiGH}}
                                                </td>
                                            </tr>

                                        </table>
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