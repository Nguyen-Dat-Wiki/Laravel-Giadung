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
        <p><span style="font-size:16px;">Với hơn 2 năm thành lập từ 10/11/2021&nbsp;đến nay, <em><strong>Hago</strong></em> tự hào là đơn vị cung cấp và phân phối các sản phẩm nội địa đến từ Nhật, Ý, Đức.... tới tay người tiêu dùng thông minh tại Việt Nam.&nbsp;<br>
        Với phương châm bán hàng chất lượng cao, bảo hành chính hãng và tư vấn tận tình, <em><strong>Hago</strong></em> cam kết sẽ mang đến cho bạn sản phẩm, dịch vụ tốt cùng với sự trải nghiệm tuyệt vời mà <em><strong>Nhà Hago</strong></em> mang lại.</span></p>

        <p><span style="font-size:16px;"><em><strong>Hago</strong></em> thật vinh hạnh khi được đồng hành cùng các bạn trong thời gian tới, chúng tôi luôn luôn mong muốn mang lại sự trải nghiệm CHẤT LƯỢNG nhất cho các bạn</span></p>

        <p><span style="font-size:16px;"><em><strong>Hago</strong></em> chuyên kinh doanh các mặt hàng điện gia dụng,&nbsp;gia đình như Bếp từ, Máy giặt, Tủ lạnh, Máy lọc không khí, Máy rửa chén, Máy lọc nước, Nồi cơm điện, Máy xay sinh tố......, đến từ các thương hiệu nổi tiếng như HITACHI, SHARP, SAMSUNG,&nbsp;ZOJIRUSHI, OSHIKA , LG, OSHIKA,.....&nbsp;</span></p>

        <p>
            <font size="3">Chúng tôi cam kết hàng chất lượng 100%, nếu có bất kỳ sự khiếu nại hoặc cần hỗ trợ thì liên hệ với chúng tôi <a href="/lien-he">Tại đây</a></font>
        </p>

        <p>
            <font size="3">Mọi thắc mắc sẽ được nhân viên chúng tôi giải quyết cho bạn sớm nhất.&nbsp;</font>
        </p>

        <p>&nbsp;</p>

        <p>
            <font size="3">Hago cảm ơn bạn đã đồng hành cùng chúng tôi .</font>
        </p>

        <p>&nbsp;</p>
    </div>
</div>
@endsection