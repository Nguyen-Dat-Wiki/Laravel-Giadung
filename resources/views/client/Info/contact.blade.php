@extends('client.index')

@section('content_new')
<div class="breadCrumbs">
    <div class="wrap-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="/"><span>Trang chủ</span></a></li>
            <li class="breadcrumb-item "><a class="text-decoration-none" href="{{request()->url()}}"><span>{{$title}}</span></a></li>
        </ol>
    </div>
</div>
<div class="title-main mb-2 text-dark text-center">
    <span>{{Str::upper($title)}}</span>
</div>
<div class="content">
    <div class="content-main w-clear">
        <div class="form-connact row justify-content-between">
            <form class="form-contact col-6 validation-contact" novalidate="" method="post" action="" enctype="multipart/form-data">
                <div class="row mb-4">
                    <div class="input-contact col-sm-6">
                        <input type="text" class="form-control" id="ten" name="name" placeholder="Họ tên" required="">
                        <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                    </div>
                    <div class="input-contact col-sm-6">
                        <input type="number" class="form-control" id="dienthoai" name="phone" placeholder="Số điện thoại" required="">
                        <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="input-contact col-sm-6">
                        <input type="text" class="form-control" id="diachi" name="address" placeholder="Địa chỉ" required="">
                        <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
                    </div>
                    <div class="input-contact col-sm-6">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
                        <div class="invalid-feedback">Vui lòng nhập địa chỉ email</div>
                    </div>
                </div>
                <div class="input-contact mb-4">
                    <input type="text" class="form-control" id="tieude" name="subject" placeholder="Chủ đề" required="">
                    <div class="invalid-feedback">Vui lòng nhập chủ đề</div>
                </div>
                <div class="input-contact mb-4">
                    <textarea class="form-control" id="noidung" name="content" placeholder="Nội dung" required=""></textarea>
                    <div class="invalid-feedback">Vui lòng nhập nội dung</div>
                </div>

                <input type="submit" class="btn btn-primary" value="Gửi">
                @csrf
                <input type="reset" class="btn btn-secondary" value="Nhập lại">
            </form>

            <div class="Img-group col-5">
                <img src="/asset/img/focus_team.jpg" width="350px" class="img-fluid" alt="">
                <h5 class="text-center h4 text-success font-weight-bold">Hago Team</h5>
            </div>

            <div id="map" class="container mb-4 mt-4 ">
                <iframe style="width: 100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5543.3960033461535!2d106.68037913965553!3d10.751977764766485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f01c3de51d1%3A0x8928a2ecd89d398b!2zMjYzRC8yIELhur9uIEJhIMSQw6xuaCwgUGjGsOG7nW5nIDgsIFF14bqtbiA4LCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1649905944435!5m2!1svi!2s"
                    height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

    </div>
</div>
@endsection