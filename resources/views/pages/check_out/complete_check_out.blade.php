@extends('welcome')
@section('contend') 
    <main>
        <div class="checkout-page-wrapper section-space pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-12" style="text-align: center;">
                        <div class="container-text">
                            Thanh toán thành công
                        </div>
                        <div class="view-more-btn">
                            <a class="btn-hero btn-load-more" href="{{URL::to('/trang_chu')}}">Trang Chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>                           
    </main>

@endsection