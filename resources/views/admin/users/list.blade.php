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
            <th>Tên Khách Hàng
                @if(request()->getQueryString() == 'name=desc')
                    <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'name=asc')
                    <a href="{{request()->url()}}?name=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th>Số Điện Thoại
                @if(request()->getQueryString() == 'phone=desc')
                    <a href="{{request()->url()}}?phone=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'phone=asc')
                    <a href="{{request()->url()}}?phone=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?phone=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Email

                @if(request()->getQueryString() == 'email=desc')
                    <a href="{{request()->url()}}?email=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'email=asc')
                    <a href="{{request()->url()}}?email=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?email=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Quyền
                @if(request()->getQueryString() == 'is_admin=desc')
                    <a href="{{request()->url()}}?is_admin=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'is_admin=asc')
                    <a href="{{request()->url()}}?is_admin=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?is_admin=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th>Ngày tạo
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
        @foreach($users as $key => $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>{!! \App\Helpers\Helper::Users($user->is_admin) !!}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/user/view/{{ $user->id }}">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="card-footer clearfix">
    {{$users->appends(request()->query())->onEachSide(1)->links()}}

</div>
@endsection