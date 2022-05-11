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
                            <span class="promo_text"> Nhập mã giảm – giảm thêm đến 700.000đ khi mua online.
                                <a href="">Xem chi tiết</a>
                            </span>
                        </p>
                    </div>
                    <div class="control-group">
                        <p class="product_option_item ">
                            <span class="num-ord rounded-circle">&nbsp;2&nbsp;</span>
                            <span class="promo_text"> Giảm thêm 500.000đ&nbsp;khi thanh toán bằng thẻ tín dụng&nbsp;
                                <a href="">Sacombank</a>
                            </span>
                        </p>
                    </div>
                    <div class="control-group ">
                        <p class="product_option_item">
                            <span class="num-ord rounded-circle">&nbsp;3&nbsp;</span>
                            <span class="promo_text"> Giảm thêm 500.000đ&nbsp;khi thanh toán bằng thẻ tín dụng&nbsp;
                                <a href="" >TPBank</a>
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
<div class="main-middle">
    <div class="main-middle-content">
        <div class="content-article">
        {!! $product->content !!}
        </div>
    </div>
</div>
@endsection




@section('main-bottom')
<hr>
<div class="main-bottom ">
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
            <div class="d-flex justify-content">
                @if (Auth::check())
                <input class="col-10" name='content' type="text" width="100%" height="50px" placeholder="Thêm bình luận" required>
                <div class="ml-auto" >
                    <button class="btn btn-primary" type="submit" id="btn-submit" style="height: 50px">Gửi bình luận </button>
                    <input type="text" hidden name="user_id" value="{!!  (isset(Auth::user()->id)) ? Auth::user()->id : '' ; !!}">
                    <input type="text" name="product_id" hidden value="{{$product->id}}">
                    <input type="text" name="name" hidden value="{!!  (isset(Auth::user()->name)) ? Auth::user()->name : 'Khách' ; !!}">
                </div>
                @else
                <input class="col-10" disabled name='content' type="text" width="100%" height="70px" placeholder="Vui lòng đăng nhập để bình luận" required>
                <div class="ml-auto" >
                    <button class="btn btn-primary" disabled type="submit" id="btn-submit" style="height: 50px">Gửi bình luận </button>
                </div>
                @endif
            </div>
            @csrf
        </form>
        <div class="contentCmt mt-4 ">
            @foreach ($comment  as $key => $item) 
                    <div class="c-comment-box d-flex mb-4 align-items-center box-comment border">
                        <div class="comment-avatar border p-5 rounded ">
                            <?php
                                $fullname =  explode(" ",$item->name);
                                $lastName = array_pop($fullname);
                                echo $lastName[0];
                            ?>
                        </div>
                        <div class="c-comment-box_content ml-3 " >
                            <div class="c-comment-name d-flex h4 m-0 align-items-center">
                                <span>{{$item->name}}</span>
                                <span class="time h6 ml-2" style="color: #99a2aa">
                                @php
                                    Carbon\Carbon::setLocale('vi');
                                    echo Carbon\Carbon::create($item->created_at)->diffForHumans();
                                    $time =  explode(" ",Carbon\Carbon::create($item->created_at)->diffForHumans());
                                @endphp
                                </span>
                            </div>
                            <div class="c-comment-text">
                                <span class="content-show">{{$item->content}}</span>
                            </div>
                        </div>
                        @if (Auth::check())
                            @if (Auth::user()->id == $item->user_id)
                                @if ($time[1]== 'giờ' || $time[1] == 'phút' ||  $time[1] == 'giây' )
                                    <div class="dropdown ml-auto d-flex flex-column">
                                        <a class=" btn-setting btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ...
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{request()->url()}}/delete={{$item->id}}">Delete</a>
                                        </div>
                                    </div>

                                @endif
                            @endif
                        @endif
                    </div> 
            @endforeach
        </div>
        <div class="text-center">
            {{$comment->links()}}
        </div>
    </div>
</div>
    
@endsection