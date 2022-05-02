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
        <h1><span><strong>BẢO TRÌ - BẢO HÀNH - ĐỔI TRẢ</strong></span></h1>

        <p><span style="font-size:16px;">Tất cả sản phẩm bên cửa hàng chúng tôi đều được bảo hành điện tử&nbsp;chính hãng lên đến <strong>24 Tháng.&nbsp;</strong></span></p>

        <p><em><span>Hago&nbsp;xin thông tin đến quý khách hàng chính sách đổi trả hàng hóa khi mua hàng&nbsp;như sau:</span></em></p>

        <h2><span><strong>I. ĐỐI VỚI HÀNG LỖI TRONG VÒNG 30&nbsp;NGÀY</strong></span></h2>

        <h3><span><strong>1. Đổi sản phẩm mới cùng model với điều kiện:</strong></span></h3>

        <h3><span>- Sản phẩm còn nguyên tem, nguyên vỏ, không trầy xước, không bị hư hỏng, khong tự ý sửa hoặc tháo linh kiện của máy và còn trong thời gian Bảo hành tại cửa hàng trong 30 ngày.</span></h3>

        <p><span>- Sản phẩm có các lỗi từ nhà sản xuất, không do tác động của ngoại lực hoặc nhân lực bên ngoài đối với sản phẩm .</span></p>

        <h3><span><strong>2. Đổi sản phẩm mới qua model khác:</strong></span></h3>

        <p><span>- Model mới phải có trị giá lớn hơn, khách hàng phải bù thêm chi phí sản phẩm mới + phí vân chuyển</span></p>

        <h3><span><strong>3. Khách hàng muốn trả lại hàng</strong></span></h3>

        <p><span>- Đối với khách hàng&nbsp;muốn trả hàng, bắt buộc sản phẩm bên công ty phải có lỗi. từ nàh sản xuất và sau chính sách 1 đổi 1 sản phẩm nếu hàng vẫn bị lỗi, bên công ty sẽ hỗ trợ hoàn tất cả chi&nbsp;phí sản phẩm cho khách.&nbsp;<br>
        - Kể từ ngày 31 trở đi (tính từ ngày mua hàng): Không chấp nhận trả hàng.</span></p>

        <p><span><strong>- Đối với các trường hợp khác, Chi nhánh liên hệ Phòng Chăm Sóc Khách Hàng hoặc Phòng Thu Mua để được hướng dẫn.</strong></span></p>

        <h2><span><strong>IV. QUY ĐỊNH VỀ BẢO HÀNH</strong></span></h2>

        <h2><span><strong>1. Các điều khoản được bảo hành:</strong><br>
        - Sản phẩm hư do lỗi kỹ thuật của máy<br>
        - Sản phẩm còn thời hạn bảo hành tính từ ngày mua và được đăng ký trên phiếu bảo hành điện tử &nbsp;hoặc hóa đơn kèm theo. Trường hợp khách hàng chưa đăng ký hoặc mất hóa đơn thì sản phẩm đó được bảo hành theo ngày xuất xưởng in trên PBH</span><br>
            <span><strong>2. Các điều khoản không được bảo hành:</strong><br>
        - Sản phẩm hư không do lỗi kỹ thuật (do thiên tai, hỏa hoạn, sét đánh, ...)<br>
        - Sản phẩm bị rỉ sét, ăn mòn do chất lỏng đổ vào hoặc hư hỏng do côn trùng gây nên<br>
        - Sản phẩm lắp đặt, sử dụng không đúng kỹ thuật sai nguồn điện hoặc điện thế không ổn định<br>
        - Sản phẩm hết hạn bảo hành hoặc không có PBH và chứng từ kèm theo hợp lệ<br>
        - Sản phẩm hư hỏng do va chạm, cấn bể<br>
        - Sản phẩm thiếu linh kiện hoặc đã được sửa chữa ở những nơi khác ngoài các địa chỉ bảo hành được chỉ định kèm theo</span><br>
            <span><strong>3. Các sản phẩm được bào hành tại nhà:</strong></span></h2>

        <h2><span>Tát cả sản phẩm bên Hago được bảo hành tận nhà cho khách hàng .</span></h2>

        <p><span>Hỗ trợ chi phí thay linh kiện sản phẩm với GIÁ GỐC tại cửa hàng&nbsp;</span></p>

        <h2><span><strong>V. MỌI CHI TIẾT LIÊN HỆ HOTLINE&nbsp;</strong></span></h2>

        <p><span>- Bộ phận chăm sóc khách hàng Hago&nbsp;</span></p>

        <p><span>- Địa chỉ: &nbsp;<meta charset="UTF-8">263D/2 Ba Đình, Phường 8, Quận 8, TP HCM</span></p>

        <p><span>- Hotline: 0938 103 176</span></p>

        <h3>&nbsp;</h3>
    </div>
</div>
@endsection