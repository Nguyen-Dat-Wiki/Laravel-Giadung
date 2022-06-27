<div class="container ">
    <div style="width:900px;margin:0 auto">

        <div style="width:95.3%;padding:0px 20px;border:1px solid skyblue;border-top:hidden">
            <div>
                <p class="m_-3452303451081584177mauxanh" style="padding-top:20px">Kính gửi Quý khách hàng:&nbsp;<strong>{{$name}}</strong></p>
                <p>Xin trân trọng cảm ơn Quý khách đã mua hàng và sử dụng dịch vụ của <span class="m_-3452303451081584177mauxanh">CÔNG TY CỔ PHẦN THƯƠNG MẠI - DỊCH VỤ <span class="il">HA</span>GO</span>
                </p>
                <p>Chúng tôi phát hành Hóa đơn điện tử cho đơn hàng <span class="m_-3452303451081584177mauxanh">22405OAC54&nbsp;</span>với các thông tin như sau:</p>
                <p class="m_-3452303451081584177mauxanh" style="font-size:20px">THÔNG TIN KHÁCH HÀNG</p>
            </div>
            <div style="border-top:1px solid skyblue;padding-left:5px">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20" width="20%">Khách hàng</td>
                            <td><strong>{{$name}}</strong></td>
                        </tr>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20">Mail</td>
                            <td><strong><a href="mailto:{{$email}}" target="_blank">{{$email}}</a></strong></td>
                        </tr>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20">Số điện thoại</td>
                            <td><strong>{{$phone}}</strong></td>
                        </tr>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20">Địa Chỉ</td>
                            <td><strong>{{$address}}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <p class="m_-3452303451081584177mauxanh" style="font-size:20px">THÔNG TIN HÓA ĐƠN</p>
            </div>
            <div style="border-top:1px solid skyblue;padding-left:5px">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20" width="20%">Mẫu số</td>
                            <td><strong>1</strong></td>
                        </tr>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20" width="20%">Ký hiệu</td>
                            <td><strong>C22TSG</strong></td>
                        </tr>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20">Số hóa đơn</td>
                            <td><strong>{{$id}}</strong></td>
                        </tr>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20">Ngày hóa đơn</td>
                            <td><strong>{{$time}}</strong></td>
                        </tr>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20">Số tiền thanh toán</td>
                            <td><strong>{{number_format($total, 0, '', '.')}}</strong></td>
                        </tr>
                        <tr>
                            <td class="m_-3452303451081584177mauxanh m_-3452303451081584177cachtrai20">Mã số thuế</td>
                            <td><strong></strong></td>
                        </tr>
                    </tbody>
                </table>
                <p>Quý khách tải hóa đơn bằng file đính kèm hoặc truy cập vào Website <span class="m_-3452303451081584177mauxanh"><a href="http://dientu.webhop.me" target="_blank" data-saferedirecturl="">http://<span class="il">dientu.webhop</span>.me/</a>
                    </span>
                    để tra cứu hóa đơn theo Mã bảo mật: <strong class="m_-3452303451081584177mauxanh">{{$id}}</strong></p>
                <p>Mã số thuế bên bán: <span class="m_-3452303451081584177mauxanh">@SELLER_TAXCODE@</span></p>
                <p>Cảm ơn quý khách đã tin tưởng và lựa chọn mua hàng tại hệ thống cửa hàng <span class="m_-3452303451081584177mauxanh"><span class="il">Ha</span>go</span>
                </p>
                <p class="m_-3452303451081584177mauxanh m_-3452303451081584177innghieng">Đây là Email tự động, Quý khách vui lòng không trả lời Email này.</p>
                <p class="m_-3452303451081584177mauxanh m_-3452303451081584177innghieng">Trân trọng./</p>
            </div>
        </div>
    </div>
</div>