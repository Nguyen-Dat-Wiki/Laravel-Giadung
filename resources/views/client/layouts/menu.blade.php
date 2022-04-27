    <!-- header -->

    <div class="header">
        <div class="header-bottom container">
            <div class="wrap-content d-flex align-items-center justify-content-between">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="/asset/img/Logo.png" alt="" width="120px" height="50px">
                </a>
                <div class="search col-md-5">
                    <form action="">
                        <input type="text" id="keyword" placeholder="Nhập từ khóa tìm kiếm">
                        <span class="fas fa-search "></span>
                    </form>
                </div>
                <div class="hotline-right d-flex align-items-center justify-content-between col-md-5">
                    <a href="tel:0788911668 " class="hotline-header d-flex align-items-center justify-content-between ">
                        <i class="fas fa-phone icon "></i>
                        <div class="combo-right ">
                            <p>Hotline tư vấn:</p>
                            <span>0788911668</span>
                        </div>
                    </a>
                    <a class="cart-header d-flex align-items-center justify-content-between " href="GioHang.html ">
                        <i class="fas fa-shopping-cart icon "></i>
                        <div class="combo-right ">
                            <p>Giỏ hàng:</p>
                            <label>(<span class="count-cart ">0</span>) sản phẩm</label>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- phone -->
    <div class="hotline-phone-ring-wrap">
        <div class="hotline-phone-ring">
            <div class="hotline-phone-ring-circle"></div>
            <div class="hotline-phone-ring-circle-fill"></div>
            <div class="hotline-phone-ring-img-circle">
                <a href="tel:0938103176" class="pps-btn-img">
                    <i style="color:#fff;font-size:25px;" class="fa fa-mobile"></i> </a>
            </div>
        </div>
    </div>

    <!-- backtop -->
    <div class="icon_back_top">
        <a href="" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>
    </div>
    <!-- menu -->
    <header class="">
        <nav class="navbar navbar-expand-lg pt-0 pb-0 mb-0 border-0">
            <div class="container">
                <div class="cot1-menu">
                    <h3>Danh mục sản phẩm</h3>
                    <div class="list-menu show-menu ">
                        <ul>
                            
                            {!! \App\Helpers\Helper::menus($menu) !!}

                        </ul>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item ">
                            <a class="nav-link active" href="Index.html" title="Trang chủ ">Trang chủ
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="GioiThieu.html" title="Giới thiệu ">Giới thiệu
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="SanPham.html" title="Khuyến mãi ">Khuyến mãi
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="ThanhToan.html" title="Thanh toán ">Thanh toán
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="BaoHanh.html" title="Bảo hành ">Bảo hành
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="TinTuc.html" title="Tin tức ">Tin tức
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="LienHe.html" title="Liên hệ ">Liên hệ
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="Login.html" title="Liên hệ ">Đăng nhập
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>