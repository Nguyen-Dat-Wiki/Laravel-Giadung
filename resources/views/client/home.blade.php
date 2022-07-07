@extends('client.index')



@section('slibar')

    <div class="slide">
        <div class="container SlideBanner" style="padding: 0;">

            <div class="col-lg-8 col-md-8 col-sm-8 slide mt-3">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                
                    <!-- Hình ảnh -->
                    <div class="carousel-inner" role="listbox">
                        @foreach ($slider as $Slider)
                            @if ($Slider->sort_by == 1)
                                @if ($Slider->id == 2)
                                    <div class="item active">
                                        <img src="{{$Slider->thumb}}">
                                    </div>
                                @else
                                    <div class="item">
                                        <img src="{{$Slider->thumb}}">
                                    </div>
                                @endif
                            @endif
                        @endforeach

                    
                    </div>

                    <!-- Nút trái phải -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 BannerSlide">
                <div class="row mr-2">
                    <span>
                        <div class="item active">
                            <a href="/404.html"><img class="m-3 img-fluid" src=" /asset/img/banner-shopeetikilazada-01-2-2726.jpg"></a>
                        </div>
                    </span>
                    <span>
                        <div class="item active">
                            <a href="/404.html"><img class="m-3 img-fluid" src="/asset/img/banner-shopeetikilazada-02-2-3404.jpg"></a>
                        </div>
                    </span>
                    <span>
                        <div class="item active">
                            <a href="/404.html"><img class="m-3 img-fluid" src="/asset/img/banner-shopeetikilazada-03-2-9939.jpg"></a>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content_new')

    <div class="main_product_new mt-4">
        <div class="title-main mb-2 border-primary border text-center">
            <span>SẢN PHẨM MỚI</span>
        </div>
        <div class="row">
            <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12">
                {!! \App\Helpers\Helper::show($products) !!}
            </div>
        </div>
    </div>
@endsection
@section('category_1')
    <div class="category-1 mb-5">
        <div class="title-main mb-2 pl-5 border-primary border">
            <span> Bàn ủi </span>
            <a class=" float-right mr-5 border-primary border" href="/danh-muc/6-ban-ui.html">Xem tất cả >></a>
        </div>
        <div class="row">
            <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12">
                {!! \App\Helpers\Helper::show($category_1) !!}
            </div>
        </div>
    </div>
@endsection
@section('category_2')
        <div class="category-1 mb-5">
            <div class="title-main mb-2 pl-5 border-primary border">
                <span> Hút bụi </span>
                <a class=" float-right mr-5 border-primary border" href="/danh-muc/7-hut-bui.html">Xem tất cả >></a>
            </div>
            <div class="row">
                <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12">
                {!! \App\Helpers\Helper::show($category_2) !!}
                </div>
            </div>
        </div>
        
@endsection
@section('category_3')
        <div class="category-1 mb-5">
            <div class="title-main mb-2 pl-5 border-primary border">
                <span> Lò vi sóng </span>
                <a class=" float-right mr-5 border-primary border" href="/danh-muc/8-lo-vi-song.html">Xem tất cả >></a>
            </div>
            <div class="row">
                <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12">
                {!! \App\Helpers\Helper::show($category_3) !!}
                </div>
            </div>
        </div>
        
@endsection
@section('category_4')
        <div class="category-1 mb-5">
            <div class="title-main mb-2 pl-5 border-primary border">
                <span>Máy lọc </span>
                <a class=" float-right mr-5 border-primary border" href="/danh-muc/9-loc-khong-khi.html">Xem tất cả >></a>
            </div>
            <div class="row">
                <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12">
                {!! \App\Helpers\Helper::show($category_4) !!}
                </div>
            </div>
        </div>
        
@endsection
@section('category_5')
        <div class="category-1 mb-5">
            <div class="title-main mb-2 pl-5 border-primary border">
                <span> Máy ép </span>
                <a class=" float-right mr-5 border-primary border" href="/danh-muc/10-may-ep.html">Xem tất cả >></a>
            </div>
            <div class="row">
                <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12">
                {!! \App\Helpers\Helper::show($category_5) !!}
                </div>
            </div>
        </div>
        
@endsection


@section('tieuchi')
    <div class="col-md-12 wrap-tieuchi-mobi">
        <div class="owl-clients owl-carousel text-center d-flex align-items-center">
            <div class="service-item my-auto">
                <div class="m box-buy-normal d-flex align-items-center justify-content-center">
                    <p class="pic-buy-normal"><img src="/asset/img/593-9332.png" width="50px" alt="Uy Tín - Chất Lượng"></p>
                    <div class="info-buy-normal">
                        <h5 class="name-buy text-split" style="color: black">Uy Tín - Chất Lượng</h5>
                        <p class="desc-buy text-split" style="color: black">Chúng tôi cam kết luôn mang đến cho quý khách hàng sự hài lòng tin cậy</p>
                    </div>
                </div>
            </div>
            <div class="service-item  my-auto">
                <div class="box-buy-normal d-flex align-items-center justify-content-center ">
                    <p class="pic-buy-normal"><img src="/asset/img/tc4093-9155.png"  width="50px"  alt="Sản phẩm chính hãng"></p>
                    <div class="info-buy-normal">
                        <h5 class="name-buy text-split" style="color: black" >Sản phẩm chính hãng</h5>
                        <p class="desc-buy text-split" style="color: black">Nhập khẩu trực tiếp từ Nhật, hàng mới 100%</p>
                    </div>
                </div>
            </div>
            <div class="service-item  my-auto">
                <div class="box-buy-normal d-flex align-items-center justify-content-center ">
                    <p class="pic-buy-normal"><img src="/asset/img/1593-5763.png" width="50px"  alt="Vận chuyển toàn quốc"></p>
                    <div class="info-buy-normal">
                        <h5 class="name-buy text-split" style="color: black">Vận chuyển toàn quốc</h5>
                        <p class="desc-buy text-split"  style="color: black">Ship code 63 tỉnh thành Việt Nam. Đơn vị giao hàng nhanh chóng</p>
                    </div>
                </div>
            </div>
            <div class="service-item  my-auto">
                <div class="box-buy-normal d-flex align-items-center justify-content-center">
                    <p class="pic-buy-normal"><img src="/asset/img/tc40-4680.png" width="50px"  alt="Hỗ trợ tư vấn 24/7"></p>
                    <div class="info-buy-normal">
                        <h5 class="name-buy text-split" style="color: black">Hỗ trợ tư vấn 24/7</h5>
                        <p class="desc-buy text-split"  style="color: black">Đội ngũ nhân viên cskh luôn sẵn sàng tư vấn </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="wrap-tieuchi content">
        <div class="wrap-content mb-5">
            <div class="slick-track d-flex " role="listbox">
                <div class="box-buy-normal d-flex align-items-center justify-content-center col-3">
                    <p class="pic-buy-normal"><img src="/asset/img/593-9332.png" alt="Uy Tín - Chất Lượng"></p>
                    <div class="info-buy-normal">
                        <h5 class="name-buy text-split">Uy Tín - Chất Lượng</h5>
                        <p class="desc-buy text-split">Chúng tôi cam kết luôn mang đến cho quý khách hàng sự hài lòng tin cậy</p>
                    </div>
                </div>
                <div class="box-buy-normal d-flex align-items-center justify-content-center col-3">
                    <p class="pic-buy-normal"><img src="/asset/img/tc4093-9155.png" alt="Sản phẩm chính hãng"></p>
                    <div class="info-buy-normal">
                        <h5 class="name-buy text-split">Sản phẩm chính hãng</h5>
                        <p class="desc-buy text-split">Nhập khẩu trực tiếp từ Nhật, hàng mới 100%</p>
                    </div>
                </div>
                <div class="box-buy-normal d-flex align-items-center justify-content-center col-3">
                    <p class="pic-buy-normal"><img src="/asset/img/1593-5763.png" alt="Vận chuyển toàn quốc"></p>
                    <div class="info-buy-normal">
                        <h5 class="name-buy text-split">Vận chuyển toàn quốc</h5>
                        <p class="desc-buy text-split">Ship code 63 tỉnh thành Việt Nam. Đơn vị giao hàng nhanh chóng</p>
                    </div>
                </div>
                <div class="box-buy-normal d-flex align-items-center justify-content-center col-3">
                    <p class="pic-buy-normal"><img src="/asset/img/tc40-4680.png" alt="Hỗ trợ tư vấn 24/7"></p>
                    <div class="info-buy-normal">
                        <h5 class="name-buy text-split">Hỗ trợ tư vấn 24/7</h5>
                        <p class="desc-buy text-split">Đội ngũ nhân viên cskh luôn sẵn sàng tư vấn </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection