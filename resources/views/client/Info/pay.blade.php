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
        <p><span>Để cho Quý Khách hàng an tâm khi mua hàng cũng như dễ dàng trong việc thanh toán, Hago xin gửi đến Quý khách hàng 3 phương thức thanh toán của cửa hàng bằng các hình thức sau:</span></p>

        <p><br>
            <span>&nbsp;1. &nbsp;Thanh toàn trực tiếp tại cửa hàng&nbsp;<br>
        &nbsp;- Địa chỉ: 263D/2 Ba Đình, Phường 8, Quận 8, TP HCM</span></p>

        <p><br>
            <span>2. Thanh toán qua Giao Hàng Tiết Kiệm ( GHTK ) - Ship COD Nhận hàng và thanh toán.</span></p>

        <p><span>&nbsp;- Quý khách khi đặt hàng vui lòng cung cấp đầy đủ thông tin sau:&nbsp;</span></p>

        <p><span>&nbsp; &nbsp; &nbsp;SỐ ĐIỆN THOẠI + TÊN NGƯỜI NHẬN HÀNG&nbsp;+ ĐỊA CHỈ để bên Shop lên đơn trên GHTK ạ.</span></p>

        <p><br>
            <span>3. Thanh toán qua Ngân hàng.&nbsp;</span></p>

        <p><span>CHỦ TK: NGUYỄN THÀNH ĐẠT<br>
        &nbsp; -&nbsp;VietinBank</span></p>

        <p><span>STK: 1068 6879 7515</span></p>

        <p><span>&nbsp; - Techcombank</span></p>

        <p><span>STK: 19 0358 6382 3012.</span><br> &nbsp;
        </p>
    </div>
</div>
@endsection