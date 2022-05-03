<div class="breadCrumbs">
    <div class="wrap-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="/"><span>Trang chủ</span></a></li>
            <li class="breadcrumb-item "><a class="text-decoration-none" href="/setting"><span>Cài đặt</span></a></li>
        </ol>
    </div>
</div>
<div class="left d-flex flex-column col-md-3">
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
<div class="right col-md-9">
    <div class="user d-flex justify-content-between" > 
        <span>Chào bạn<b> {{Auth::user()->name}}</b> - <b>{{Auth::user()->phone}}</b></span>
    </div>
        {{-- <div class="right">
            <div class="user" data-customer="1012548761">
                Chào anh
                <b>nguyễn thành đạt</b> - <b>0938103176</b>
                <a href="/lich-su-mua-hang/dang-xuat" class="logout-h">Thoát tài khoản</a>
                <a class="about-s">|</a>
                
                <div class="result"></div>
                        <div class="profile">
                            <h3>Thông tin cá nhân</h3>
                            <div>
                                <span class="active" data-val="1"><i></i><b>Anh</b></span>
                                <span class="" data-val="0"><i></i><b>Chị</b></span>
                                <input type="hidden" name="hdGender" value="1">
                            </div>
                            <input type="text" name="txtFullName" value="nguyễn thành đạt">
                            <input type="tel" name="txtPhoneNumber" disabled="" value="0938103176">
                            <h3>Địa chỉ nhận hàng</h3>
                            <span id="add35207957" data-id="35207957" class="address active">
                                <span>263d/2 ba dinh, Phường 8, Quận 8, Hồ Chí Minh</span><br>
    <em>Địa chỉ mặc định</em><br>            <a href="javascript:;" onclick="AddressEdit($(this).parent(), 35207957)" class="edit"><i class="iconlsmh-edit"></i>Sửa</a>
            </span>
    <button type="submit" class="button">CẬP NHẬT</button>
            @csrf
                </div>
            </div>
        </div> --}}