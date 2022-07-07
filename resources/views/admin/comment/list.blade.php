@extends('admin.index')



@section('content')
<div class="table-responsive table-responsive-lg">
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID
                @if(request()->getQueryString() == 'id=desc')
                    <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'id=asc')
                    <a href="{{request()->url()}}?id=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Tên Sản Phẩm
                @if(request()->getQueryString() == 'name_product=desc')
                    <a href="{{request()->url()}}?name_product=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'name_product=asc')
                    <a href="{{request()->url()}}?name_product=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?name_product=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th>Tên Người Dùng
                @if(request()->getQueryString() == 'name=desc')
                    <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'name=asc')
                    <a href="{{request()->url()}}?name=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Nội dung

                @if(request()->getQueryString() == 'content=desc')
                    <a href="{{request()->url()}}?content=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'content=asc')
                    <a href="{{request()->url()}}?content=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?content=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Ngày Bình luận
                @if(request()->getQueryString() == 'created_at=desc')
                    <a href="{{request()->url()}}?created_at=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'created_at=asc')
                    <a href="{{request()->url()}}?created_at=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?created_at=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::comment($comments) !!}
           
        </tbody>
    </table>
</div>

<div class="card-footer clearfix">
    {{$comments->appends(request()->query())->onEachSide(1)->links()}}

</div>
@endsection