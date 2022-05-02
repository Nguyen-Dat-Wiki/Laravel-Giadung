<div class="container ">
    <div class="mail mx-auto border" style="width: 500px;">
        <div class="header ">
            <h2>Kính chào Hago</h2>
        </div>
        <div class="main ">
            <h4>Thông tin khách hàng:</h4>
            <ul>
                <li>
                    Họ tên: <strong>{{$name}}</strong>
                </li>
                <li>
                    Số điện thoại: <strong>{{($phone)}}</strong>
                </li>
                <li>
                    Địa chỉ: <strong>{{($address)}}</strong>
                </li>
                <li>
                    Mail: <strong>{{($email)}}</strong>
                </li>
            </ul>
            <p>Tôi xin phép đặt câu hỏi như sau: <strong>{{($content)}}</strong></p>
        </div>
        <div class="footer ">
            <p>Cảm ơn quý khách đã tin tưởng và lựa chọn mua hàng tại hệ thống cửa hàng Hago </p>
            <p>Đây là Email tự động, Quý khách vui lòng không trả lời Email này.</p>
            <p> Trân trọng./</p>
        </div>
    </div>
</div>