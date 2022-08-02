@extends('client.layouts.index')

@section('content_new')
<div class="main-content">
    <div class="breadCrumbs">
        <div class="wrap-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="/"><span>Trang chủ</span></a></li>
                <li class="breadcrumb-item "><a class="text-decoration-none" href="/danh-muc"><span>{{$title}}</span></a></li>
                <li class="breadcrumb-item "><a class="text-decoration-none" href="{{request()->url()}}"><span>{!! (isset($title2)) ? $title2 : "" !!}</span></a></li>
            </ol>
        </div>
    </div>
    <div class="title-main mb-2 text-dark text-center">
        <span>
            {!! (isset($title2)) ? $title2 : $title !!}
        </span>
    </div>
    <div class="TitleBox headerBox">
        <form action="#" method="get" id="Kho">
            <div class="Kho">
                @if (isset($_GET['tinhtrang']))
                    @if ($_GET['tinhtrang'] == 2)
                        <select class="tinhtrang" name="tinhtrang" id="TonKho">
                            <option value="2" selected>--Tình trạng--</option>
                            <option value="1">Còn hàng</option>
                            <option value="0">Sắp ra mắt</option>
                        </select>
                    @else
                        <select class="tinhtrang" name="tinhtrang" id="TonKho">
                            <option value="2">--Tình trạng--</option>
                            <option value="1" {!! ($_GET['tinhtrang'] == 1) ? 'selected' : '' ;  !!} >Còn hàng</option>
                            <option value="0" {!! ($_GET['tinhtrang'] == 0) ? 'selected' : '' ;  !!}>Sắp ra mắt</option>
                        </select>
                    @endif
                @else
                    <select class="tinhtrang" name="tinhtrang" id="TonKho">
                        <option value="2" selected >--Tình trạng--</option>
                        <option value="1" >Còn hàng</option>
                        <option value="0">Sắp ra mắt</option>
                    </select>
                    
                @endif
            </div>
        </form>
        <form action="#" method="get">
            <div class="Gia ">
                <ul>
                    <li>Lọc giá tiền</li>
                    <li class="input "><input type="text" name="start" value="0"></li>
                    <li class="input "><input type="text" name="end" value="10000000"></li>
                    <li><button class="btn btn-primary" type="submit" style="height: 37px; ">Lọc</button></li>
                </ul>
            </div>
        </form>
    </div>
    <div class="listGroupProduct ">
        <ul>
            <li><a class="btn" href="{{request()->url()}}?created_at=asc"">Hàng mới</a></li>
            <li><a class="btn" href="# ">Xem Nhiều</a></li>
            <li><a class="btn" href="{{request()->url()}} ">Giá Khuyến mãi</a></li>
            <li><a class="btn" href="{{request()->url()}}?price=asc"">Giá Tăng dần</a></li>
            <li><a class="btn" href="{{request()->url()}}?price=desc""">Giá Giảm dần</a></li>
        </ul>
        <form action="" method="GET" id="Loc">
            <div class=" ">
                <select class="LocSP " name="LocSP" id="asc_name">
                    <option selected="selected ">--Lọc sản phẩm--</option>
                    <option value="desc">Đánh giá</option>
                    <option value="asc">Từ A -> Z</option>
                </select>
            </div>
        </form>
    </div>
</div>
<div class="main-product">
    <div class="row">
        <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12">
            @if (count($products)>0)
                @foreach ($products as $product)
                    <div class="card tooltip{{$product->id}}">
                        <form class="form_addcart" action="/add-cart" method="post" >
                            <div class="card-body">
                                <div class="card-img">
                                    <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html" ><img class="img-product" src="{{$product->thumb}}" alt="..."></a>
                                    <span class="sale">-{{  (int)( ( ($product->price - $product->price_sale) * 100) / $product->price ) }}%</span>
                                </div>
                                <div class="card-top">
                                    <h3 class="card-title" style="text-align: center;"><a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}" style="color: black;">{{$product->name}}</a></h3>
                                </div>
                                @if ($product->quantity == 0)
                                    <div class="text-center lien_he">
                                        <a class="h3" href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html">Liên hệ</a>
                                    </div>
                                @elseif ($product->active == 0 )
                                    <div class="text-center lien_he">
                                        <a class="h3" href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html">Liên hệ</a>
                                    </div>
                                @else
                                    <p class="card-user">
                                        <span class="moneyold">{{number_format($product->price)}}đ</span>&nbsp;&nbsp;
                                        <span class="moneysale">{{number_format($product->price_sale)}}đ</span>
                                    </p>
                                @endif
                                <div class="button-submit d-flex justify-content-center"><button class="bg-white border-primary text-dark" type="submit">Mua ngay&nbsp; <i class="fa-solid fa-basket-shopping-simple"></i></button></div>
                            </div>
                            <input type="number" name="num_product" hidden value="1">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @csrf
                        </form>
                    </div>
                @endforeach
            @else
                <h2 class="mx-auto mb-4">Không tìm thấy sản phẩm</h2>
            @endif
        </div>
    </div>
    <div class="paganation d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            {{$products->appends(request()->query())->onEachSide(1)->links()}}
        </nav>
    </div>
</div>
@endsection