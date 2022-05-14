@extends('admin.login')

@section('title')
    Đăng ký
@endsection

@section('content')
    <h3 class="text-center ">Thông tin tài khoản</h3>
    <form  class="form-signup" method="POST" action="{{ route('register') }}">
        <div class="social-login">
            <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>
        </div>
        <div class="social-login">
            <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
        </div>
        
        <p style="text-align:center">OR</p>

        <input id="name" placeholder="Họ tên" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input id="phone" placeholder="Số điện thoại" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="Phone">
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input id="password" placeholder="Mật khẩu" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input id="password-confirm" placeholder="Nhập lại nhật khẩu" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

        <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> {{ __('Register') }}</button>

        <a  id="cancel_signup" href="{{ route('login') }}">
            <i class="fas fa-angle-left"></i> {{ __('Back') }}
        </a>
    </form>
@endsection
