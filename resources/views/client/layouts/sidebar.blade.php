<div class="breadCrumbs">
    <div class="wrap-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="/"><span>Trang chủ</span></a></li>
            <li class="breadcrumb-item "><a class="text-decoration-none" href="/setting"><span>Cài đặt</span></a></li>
        </ol>
    </div>
</div>
<div class="left d-flex flex-column col-md-3 col-sm-3">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{route('setting')}}" class="nav-link text-dark {!!  (request()->url() == route('setting') ) ? 'active': ''  !!}"><span class="fa-solid fa-rectangle-list"></span>&nbsp; Thông tin cá nhân và sổ địa chỉ  </a>
        </li>
        <li class="nav-item">
            <a href="{{route('show',Auth::user()->id)}}" class="nav-link text-dark {!!  (request()->url() == route('show',Auth::user()->id) ) ? 'active': ''  !!}"> <span class="fa-solid fa-circle-user"></span>&nbsp; Danh sách đơn hàng đã mua</a>
        </li>
        <li class="nav-item">
            <a href="{{route('pass')}}" class="nav-link text-dark {!!  (request()->url() == route('pass') ) ? 'active': ''  !!}"><i class="fa-solid fa-lock-keyhole"></i>&nbsp; Đổi mật khẩu</a>
        </li>
    </ul>
</div>
<div class="right col-md-9 col-sm-9">
    <div class="user d-flex justify-content-between" > 
        <span>Chào bạn<b> {{Auth::user()->name}}</b> - <b>{{Auth::user()->phone}}</b></span>
    </div>
        