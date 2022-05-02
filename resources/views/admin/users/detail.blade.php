@extends('admin.index')

@section('content')

<form action="" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Họ tên</label>
                    <input type="text" name="name" value="{{$user[0]['name']}}" class="form-control"  placeholder="Nhập tên">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Số điện thoại</label>
                    <input type="text" name="phone" value="{{$user[0]['phone']}}" class="form-control"  placeholder="Nhập số điện thoại">
                </div>
            </div>

            
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Email</label>
                    <input type="email" name="email" value="{{$user[0]['email']}}" class="form-control"  placeholder="Mật khẩu cũ">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Quyền</label>
                    <select class="form-control" name="is_admin">
                        <option value="0" {!!  ($user[0]['is_admin'] == 0) ? 'selected' : '' ; !!} >User</option>
                        <option value="1" {!!  ($user[0]['is_admin'] == 1) ? 'selected' : '' ; !!}>Admin</option>
                    </select>
                </div>
            </div>
        </div>

        <input type="text" name="id" hidden value="{{$user[0]['id']}}">
        <button type="submit">Xác nhận</button>
        @csrf
    </div>
</form>
@endsection