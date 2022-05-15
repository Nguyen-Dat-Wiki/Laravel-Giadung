@extends('client.index')

@section('content_new')
    @include('client.layouts.sidebar')

    <div class=" mb-4">
        @include('client.layouts.alert')
        @if (auth::user()->password != null)
            <form action="/setting/pass" method="post">
                <div class="carted">
                    <h3 sty>Thay đổi mật khẩu</h3>
                    <hr>
                    <div class="form-group">
                        <label for="old_pass">Mật khẩu cũ</label>
                        <input type="password" name="old_pass" value="" class="form-control" placeholder="Nhập mật khẩu hiện tại" >
                    </div>
                    <div class="form-group">
                        <label for="new_pass">Mật khẩu mới</label>
                        <input type="password" name="new_pass" value="" class="form-control"  placeholder="Mật khẩu mới" >
                    </div>
                    <div class="form-group">
                        <label for="confirm_pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_pass" value="" class="form-control"  placeholder="Xác nhận mật khẩu" >
                    </div>
                    <button class="btn btn-primary" type="submit">Xác nhận</button>
                    <input type="text" hidden name='id' value="{{Auth::user()->id}}">
                    @csrf
                </div>
            </form>
        @else
        <form action="/setting/passnew" method="post">
            <div class="carted">
                <h3 sty>Cập nhật mật khẩu</h3>
                <hr>
                <div class="form-group">
                    <label for="new_pass">Mật khẩu mới</label>
                    <input type="password" name="new_pass" value="" class="form-control"  placeholder="Mật khẩu mới" >
                </div>
                <div class="form-group">
                    <label for="confirm_pass">Xác nhận mật khẩu</label>
                    <input type="password" name="confirm_pass" value="" class="form-control"  placeholder="Xác nhận mật khẩu" >
                </div>
                <button class="btn btn-primary" type="submit">Xác nhận</button>
                <input type="text" hidden name='id' value="{{Auth::user()->id}}">
                @csrf
            </div>
        </form>
        @endif
    </div>
@endsection
