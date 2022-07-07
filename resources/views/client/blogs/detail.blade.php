@extends('client.layouts.index')

@section('head')
    <link rel="stylesheet" href="/asset/css/blog.css">
@endsection
@section('content_new')

<div class="breadCrumbs">
    <div class="wrap-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="/"><span>Trang chủ</span></a></li>
            <li class="breadcrumb-item "><a class="text-decoration-none" href="/tin-tuc"><span>Tin tức</span></a></li>
            <li class="breadcrumb-item "><a class="text-decoration-none" href="{{request()->url()}}"><span>{{$title}}</span></a></li>
        </ol>
    </div>
</div>

<div class="news">
    <div class="d-flex  flex-wrap">
        <div class="slider-news col-lg-3">
            {{-- search blog --}}
            <div class="search_blog mb-4">
                <form action="{{route('search')}}" method="GET">
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
            <div class="border px-3 mb-4">
                <div class="title-main text-dark  text-capitalize">
                    <span>{{($title)}}</span>
                    <div class="border-blog my-4"></div>
                </div>
                <div class="time mb-4">
                    <span>Đăng lúc {{date_format($new->created_at,'d-m-Y')}}</span>
                    <span>bởi {{Str::upper($new->name)}}</span>
                </div>
                <div class="main">
                    <div class="thumb">
                        <img src="{{$new->thumb}}" width="100%" alt="">
                    </div>
                    <style>
                        .content img{
                            width: 100%
                        }
                        ::marker {
                            padding-left: 4%                            
                        }
                    </style>

                    <div class="content">
                        {!! $new->content !!}
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection