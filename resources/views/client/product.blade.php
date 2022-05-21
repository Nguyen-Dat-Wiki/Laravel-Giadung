@extends('client.index')

@section('main-header')
<div class="main-header">
    <div class="left-main col-lg-6">

        <img src="{{$product->thumb}}" width="100%" alt="">
    </div>
    <div class="right-main col-lg-6">
        <div class="productInfo_col-23">
            <div class="breadCrumbs">
                <div class="pdp_breadcrumbs">
                    <a title="Trang chủ" href="/">Trang chủ</a>
                    <span><i class="fas fa-angle-right" ></i></span>
                    <a title="" href="/danh-muc">Danh mục</a>
                    <span><i class="fas fa-angle-right"></i></span>
                    <a title="Quạt" href="/danh-muc/{{ $product->menu->id }}-{{ Str::slug($product->menu->name, '-') }}">{{$product->menu->name}}</a>
                    <span><i class="fas fa-angle-right" ></i></span>
                    <a title="" class="last-item" href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}">{{$product->name}} </a>
                </div>
                <div class="wrap_name_vote">
                    <h3 class="product_info_name">{{$product->name}}</h3>
                </div>
            </div>
            <hr>
            @if ($product->quantity == 0)
                <div class="text-center lien_he">
                    <a class="h3" href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}">Liên hệ</a>
                </div>
            @else
                <div class="product_info_left">
                    <div class="product_info_price_value-final text-center mb-3"><span class="nk-price-final h3 font-weight-bold">{{number_format($product->price_sale)}}đ</span></div>
                    <div class="price_promotion d-flex justify-content-center align-content-center">
                        <span class="nk-product-discount-percent ">-{{  (int)( ( ($product->price - $product->price_sale) * 100) / $product->price ) }}%</span>
                        <s class="product_info_price_value-real">{{number_format($product->price)}}đ</s>
                    </div>
                </div>
                <form action="/add-cart" method="POST">
                    <div class="button-order mb-3">
                        <button class="hoso col-5" type="submit">
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                    <input type="number" name="num_product" hidden value="1">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @csrf
                </form>
                
            @endif
            <hr>   
            <div class="banner">
                <img src="/asset/img/OL-MDAW3-T04-home790.png" width="100%" alt="">
            </div>
            <div class="text-center mb-4">Gọi đặt mua <a href="tel:0938103176">0938.103.176</a> (08h - 21h)</div>
            <div class="detail_sale mb-4">
                <div class="product-options ">
                    <div class="control-group ">
                        <p class="product_option_item ">
                            <span class="num-ord rounded-circle">&nbsp;1&nbsp;</span>
                            <span class="promo_text"> Nhập mã giảm <strong>NEWBER</strong> dành cho người mới để giảm thêm đến 50.000đ khi mua online.
                            </span>
                        </p>
                    </div>
                    <div class="control-group">
                        <p class="product_option_item ">
                            <span class="num-ord rounded-circle">&nbsp;2&nbsp;</span>
                            <span class="promo_text"> Nhập mã giảm <strong>THIEUNHI</strong> để giảm 5%&nbsp;khi thanh toán bằng thẻ tín dụng&nbsp;
                            </span>
                        </p>
                    </div>
                    <div class="control-group ">
                        <p class="product_option_item">
                            <span class="num-ord rounded-circle">&nbsp;3&nbsp;</span>
                            <span class="promo_text">Nhập mã giảm <strong>SHIPCOD</strong> để giảm 3%&nbsp;khi thanh toán bằng tiền mặt&nbsp;
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('main-middle')
<div class="main-middle  col-lg-12">
    <div class="main-middle-content">
        <ul class="nav-tabs nav navDH" role="tablist">
            <li role="presentation"class="active"><a href="#Reply" class="text-dark" role="tab" data-toggle="tab">Thông tin sản phẩm</a></li>
            <li role="presentation"><a href="#GH" class="text-dark" a role="tab" data-toggle="tab">Thông số kĩ thuật</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active " id="Reply">
                <h3 class="mb-4">Thông tin sản phẩm</h3>
                <div class=" content-article">
                    {!! $product->content !!}
                </div>
            </div>
            <div role="tabpanel" class="tab-pane " id="GH">
                <div class="parameter">
                    <h3>Thông số kĩ thuật</h3>
                    <ul class="parameter-info">
                        <li class="">
                            <span class="col-4">Loại</span>
                            <span>{{$product->menu->name}}</span>
                        </li>
                        <li class=" ">
                            <span class="col-4">Công suất</span>
                            <span>{{$info->wattage}}</span>
                        </li>
                        <li class="" data-index="0" data-prop="0">
                            <span class="col-4">Điều khiển</span>
                            <span class="">{{$info->control}}</span>
                        </li>
                        <li class="" data-index="0" data-prop="0">
                            <span class="col-4">Kích thước</span>
                            <span class="">{{$info->size}}</span>
                        </li>
                        
                        <li class=" ">
                            <span class="col-4">Tiện ích</span>
                            <span class="">{{$info->utilities}}</span>
                        </li>
                        <li class="" data-index="0" data-prop="0">
                            <span class="col-4">Thương hiệu của</span>
                            <span class="">{{$info->trademark}}</span>
                        </li>
                        <li class="" data-index="0" data-prop="0">
                            <span class="col-4">Sản xuất tại</span>
                            <span class="">{{$info->produce}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('main-bottom')
<div class="main-bottom col-lg-12">
    <hr>
    <div class="Commnet mb-4 d-flex flex-column  justify-content-center">
        <form action="" method="POST" id="submit_comment">
            <div class="d-flex  justify-content-between mb-4">
                <span>{{count($comment)}} bình luận</span>
                <span>Sắp xếp theo
                    <select class="select" name="select">
                        <option selected="selected">Mới nhất</option>
                        <option >Cũ nhất</option>
                    </select>
                </span>
            </div>
        </form>
        <form method="POST" action="" id="comment_form">
            <div class="form-group">
             <input type="text" name="name" id="comment_name" class="form-control" placeholder="Enter Name" />
            </div>
            <div class="form-group">
             <textarea name="content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="product_id" value="{{$product->id}}" />
                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                <button type="submit" name="submit" id="submit" class="btn btn-info" >Gửi bình luận</button>
                @csrf
            </div>
        </form>
        <div id="display_comment">
            {!! \App\Helpers\Helper::fetch_comment($comment,$product->id) !!}
        </div>
        <div class="">
            {{$comment->links()}}
        </div>
    </div>
</div>
    
@endsection


@section('tieuchi')
<div class="main-product col-lg-12">
    <div class="">
        <h4>Sản phẩm đã xem</h4>
    </div>
    <div class="row">
        <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12 seen" >
            
        </div>
    </div>
</div>
<div class="main-product col-lg-12">
    <div class="">
        <h4>Sản phẩm khác</h4>
    </div>
    <div class="row">
        <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12">
            @foreach ($products as $product)
                <div class="card">
                    <form action="/add-cart" method="post" onclick = "Seen({{$product->id}})">
                        <div class="card-body">
                            <div class="card-img">
                                <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html"><img class="img-product" src="{{$product->thumb}}" alt="..."></a>
                                <span class="sale">-{{  (int)( ( ($product->price - $product->price_sale) * 100) / $product->price ) }}%</span>
                            </div>
                            <div class="card-top">
                                <h3 class="card-title" style="text-align: center;"><a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}" style="color: black;">{{$product->name}}</a></h3>
                            </div>
                            @if ($product->quantity == 0)
                                <div class="text-center lien_he">
                                    <a class="h3" href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}">Liên hệ</a>
                                </div>
                            @else
                                <p class="card-user">
                                    <span class="moneyold">{{number_format($product->price)}}đ</span>&nbsp;&nbsp;
                                    <span class="moneysale">{{number_format($product->price_sale)}}đ</span>
                                </p>
                            @endif
                            <div class="button-submit d-flex justify-content-center"><button class="bg-white border-primary text-dark" type="submit">Mua ngay&nbsp; <i class="fa-solid fa-basket-shopping-simple"></i></button></div>
                        </div>
                        <input type="text" name="url" hidden id="url{{$product->id}}" value="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html">
                        <input type="text" name="sale" hidden id="sale{{$product->id}}" value="{{  (int)( ( ($product->price - $product->price_sale) * 100) / $product->price ) }}">
                        <input type="text" name="thumb" hidden id="thumb{{$product->id}}" value="{{$product->thumb}}">
                        <input type="text" name="price_old" hidden id="price{{$product->id}}" value="{{number_format($product->price)}}">
                        <input type="text" name="price" hidden id="price_old{{$product->id}}" value="{{number_format($product->price_sale)}}">
                        <input type="text" name="name" id="name{{$product->id}}" hidden value="{{$product->name}}">
                        <input type="text" name="name" id="token{{$product->id}}" hidden value="{{csrf_token()}}">
                        <input type="number" name="num_product" hidden value="1">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @csrf
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection