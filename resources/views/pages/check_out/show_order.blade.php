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
                            <h1>THÔNG TIN CÁC ĐƠN HÀNG</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{URL::to('/trang_chu')}}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đơn Hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- my account wrapper start -->
    <div class="my-account-wrapper section-space pb-0">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#orders_process" class="active" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i>Đơn Hàng Đang Xử Lý</a>

                                        <a href="#orders_shipping" data-toggle="tab"><i class="fa fa-map-marker"></i>Đơn Hàng Đang Giao</a>

                                        <a href="#orders_delivered" data-toggle="tab"><i class="fa fa-map-marker"></i>Đơn Hàng Đã Giao</a>

                                        <a href="#orders_cancel" data-toggle="tab"><i class="fa fa-map-marker"></i>Đơn Hàng Đã Huỷ</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade active" id="orders_process" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Đơn Hàng Của Bạn</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Mã Đơn</th>
                                                                <th>Ngày Đặt Hàng</th>
                                                                <th>Tổng</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if($orders_process!=null)
                                                        @foreach($orders_process as $key1 => $value1)    
                                                            <tr>
                                                                <td>{{$value1->SoDonDH}}</td>
                                                                <td>{{$value1->NgayDH}}</td>
                                                                <td>{{number_format($value1->ThanhTien , 0, ',', ' ').'đ';}}</td>
                                                                <td>
                                                                    <a href="{{URL::to('/order_detail/'.$value1->SoDonDH)}}" class="btn btn__bg">Xem</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4">Không có đơn hàng</td>
                                                            </tr>
                                                        @endif    
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders_shipping" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Đơn Hàng Của Bạn</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Mã Đơn</th>
                                                                <th>Ngày Đặt Hàng</th>
                                                                <th>Tổng</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if($orders_shipping!=null)
                                                        @foreach($orders_shipping as $key1 => $value1)    
                                                            <tr>
                                                                <td>{{$value1->SoDonDH}}</td>
                                                                <td>{{$value1->NgayDH}}</td>
                                                                <td>{{number_format($value1->ThanhTien , 0, ',', ' ').'đ';}}</td>
                                                                <td><a href="{{URL::to('/order_detail/'.$value1->SoDonDH)}}" class="btn btn__bg">Xem</a></td>
                                                            </tr>
                                                        @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4">Không có đơn hàng</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders_delivered" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Đơn Hàng Của Bạn</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Mã Đơn</th>
                                                                <th>Ngày Đặt Hàng</th>
                                                                <th>Tổng</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if($orders_delivered!=null)    
                                                        @foreach($orders_delivered as $key1 => $value1)    
                                                            <tr>
                                                                <td>{{$value1->SoDonDH}}</td>
                                                                <td>{{$value1->NgayDH}}</td>
                                                                <td>{{number_format($value1->ThanhTien , 0, ',', ' ').'đ';}}</td>
                                                                <td><a href="{{URL::to('/order_detail/'.$value1->SoDonDH)}}" class="btn btn__bg">Xem</a></td>
                                                            </tr>
                                                        @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4">Không có đơn hàng</td>
                                                            </tr>
                                                        @endif     
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders_cancel" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Đơn Hàng Của Bạn</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Mã Đơn</th>
                                                                <th>Ngày Đặt Hàng</th>
                                                                <th>Tổng</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if($orders_cancel!=null)
                                                        @foreach($orders_cancel as $key1 => $value1)    
                                                            <tr>
                                                                <td>{{$value1->SoDonDH}}</td>
                                                                <td>{{$value1->NgayDH}}</td>
                                                                <td>{{number_format($value1->ThanhTien , 0, ',', ' ').'đ';}}</td>
                                                                <td><a href="{{URL::to('/order_detail/'.$value1->SoDonDH)}}" class="btn btn__bg">Xem</a></td>
                                                            </tr>
                                                        @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="4">Không có đơn hàng</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->
</main>
<!-- main wrapper end -->
@endsection    