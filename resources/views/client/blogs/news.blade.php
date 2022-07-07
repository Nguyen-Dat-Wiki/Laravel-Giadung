@extends('client.layouts.index')

@section('head')
    <link rel="stylesheet" href="/asset/css/blog.css">
@endsection
@section('content_new')

<div class="breadCrumbs">
    <div class="wrap-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="/"><span>Trang chủ</span></a></li>
            <li class="breadcrumb-item "><a class="text-decoration-none" href="/tin-tuc"><span>{{$title}}</span></a></li>
            <li class="breadcrumb-item "><a class="text-decoration-none" href="{{request()->url()}}"><span>{!! (isset($title2)) ? $title2 : "" !!}</span></a></li>
        </ol>
    </div>
</div>
<div class="title-main mb-2 text-dark text-center">
    <span>{!! (isset($title2)) ? Str::upper($title2) : Str::upper($title) !!}</span>
</div>
<div class="news">
    <div class="d-flex flex-wrap">
        
        <div class="slider-news col-lg-3 mb-4">
            {{-- search blog --}}
            <div class="search_blog mb-4">
                <form action="{{route('search_blog')}}" method="GET">
                    <input type="text" id="keyword" name="search" width="100%" placeholder="Nhập từ khóa tìm kiếm">
                    <span><button class="fas fa-search"  type="submit"></button></span>
                </form>
            </div>
            {{-- Blog news --}}
            <div class="blog_news mt-4">
                <div class="header-blog ">
                    <h4>Bài viết mới</h4>
                    <span class="border-blog"></span>
                </div>
                <div class="main-blog">
                    <div class="rounded">
                        <ul>
                            @foreach ($news_time as $new)
                                <li>
                                    <a class="" style="color: black" href="/tin-tuc/{{ $new->id }}-{{ Str::slug($new->title, '-') }}.html">{{$new->title}}</a>
                                </li>
                                <hr>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="slider-QC">
                    <div class="">
                        <a href="">
                            @foreach ($slider as $item)
                                @if ($item->sort_by == 2)
                                    <img src="{{$item->thumb}}" width="100%" height="350px" alt="">
                                @endif
                            @endforeach
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="main-news col-lg-9">
            <div class="cards col-xs-auto col-sm-12 col-md-12 col-lg-12">
                @if (count($news)> 0)
                    @foreach ($news as $new)
                        <div class="card">
                            <div class="card-body">
                                <div class="card-img">
                                    <a href="/tin-tuc/{{ $new->id }}-{{ Str::slug($new->title, '-') }}.html"><img class="img-product" src="{{$new->thumb}}" alt="..."></a>
                                </div>
                                <div class="card-top">
                                    <h3 class="card-title font-weight-bold" style="text-align: center;"><a href="/tin-tuc/{{ $new->id }}-{{ Str::slug($new->title, '-') }}.html" style="color: black;">{{$new->title}}</a></h3>
                                </div>
                                
                                <p class="card-user">
                                    <span class="description"><a  style="color: black" href="/tin-tuc/{{ $new->id }}-{{ Str::slug($new->title, '-') }}.html">{{$new->description}}</a></span>&nbsp;&nbsp;
                                </p>
                            </div>
                        </div>
                        
                    @endforeach
                @else
                    <h3 class="mx-auto">Không tìm thấy thông tin phù hợp</h3>
                @endif
                
            </div>
           
        </div>
    </div>
    <div class="text-center">
        {{$news-> links()}}

    </div>
</div>
@endsection