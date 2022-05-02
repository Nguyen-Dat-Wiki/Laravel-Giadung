@extends('admin.index')



@section('content')
<table class="table">
    <thead>
    <tr>
        <th style="width: 50px">ID</th>
        <th>Tên Khách Hàng</th>
        <th>Số Điện Thoại</th>
        <th>Email</th>
        <th>Quyền</th>
        <th>Ngày Đặt hàng</th>
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

<div class="card-footer clearfix">
    {!! $users->links() !!}
</div>
@endsection