@extends('admin.index')

@section('content')
<div class="row mt-3">
    <form action="" method="POST" class=" col-lg-5">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Search name">
            <button class="btn btn-outline-secondary" type="submit" >search</button>
        </div>
        @csrf
    </form>
</div>

    <div class="table-responsive table-responsive-lg">
        <table class="table table-bordered">
            <thead>
                <tr  id="table">
                    <th style="width: 60px">ID
                        @if(request()->getQueryString() == 'id=desc')
                            <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'id=asc')
                            <a href="{{request()->url()}}?id=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort"></i></a>
                        @endif
                    </th>
                    <th>Người đăng
                        @if(request()->getQueryString() == 'name=desc')
                            <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'name=asc')
                            <a href="{{request()->url()}}?name=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort"></i></a>
                        @endif
                    </th>
                    <th>Tiêu đề
                        @if(request()->getQueryString() == 'title=desc')
                            <a href="{{request()->url()}}?title=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'title=asc')
                            <a href="{{request()->url()}}?title=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?title=asc"> <i class="fas fa-sort"></i></a>
                        @endif
                    </th>
                    <th>Active</th>
                    <th>Create
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
                @foreach($news as $key => $new)
                <tr>
                    <td>{{ $new->id }}</td>
                    <td>{{ $new->name }}</td>
                    <td>{{ $new->title }}</td>
                    <td>{!! \App\Helpers\Helper::active($new->active) !!}</td>
                    <td>{{ ($new->created_at) }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/blogs/edit/{{ $new->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                           onclick="removeRow({{ $new->id }}, '/admin/blogs/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        {{$news->appends(request()->query())->onEachSide(1)->links()}}

    </div>

@endsection




