@extends('client.layouts.index')

@section('content_new')
    @include('client.layouts.sidebar')

    <div class="row m-0 ">
        <div class="customer mt-3">
            <div class="displayactive"> 
                @switch($customer->active)
                    @case(1)
                        <div class="p-2 rounded btn-danger">
                            <span class="">Đơn hàng đã bị huỷ</span>
                        </div>
                        @break
                    @case(2)
                        <div class="p-2 rounded btn-primary"><span class="">Đơn hàng đang chờ xác nhận, vui lòng chờ để xác nhận</span></div>
                        @break
                    @case(3)
                        <div class="p-2 rounded btn-warning"><span class="">Đơn hàng đang vận chuyển, vui lòng chờ để nhận hàng</span></div>
                        @break
                    @case(4)
                        <div class="p-2 rounded btn-success"><span class="">Đơn hàng đã hoàn thành, cảm ơn bạn đã mua sắm tại Hago</span></div>
                        @break
                    @default
                @endswitch
            </div>
            
            <div class="displayinfo p">
                <h4>Thông tin đơn hàng</h4>
                <ul class="p-2">
                    <li>Tên khách hàng: <strong>{{ $customer->name }}</strong></li>
                    <li>Số điện thoại: <strong>{{ $customer->phone }}</strong></li>
                    <li>Địa chỉ: <strong>{{ $customer->address }}</strong></li>
                    <li>Email: <strong>{{ $customer->email }}</strong></li>
                    <li>Ghi chú: <strong>{{ $customer->content }}</strong></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="carts">
        @php $total = 0; @endphp
        <div class="table-responsive-sm table-responsive-lg">
            <table class="table">
                <thead>
                    <tr class="table_head">
                        <th class="column-2" >Hình ảnh</th>
                        <th class="column-3">Tên sản phẩm</th>
                        <th class="column-4">Giá</th>
                        <th class="column-5">Số lượng</th>
                        <th class="column-6">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $key => $cart)
                        @php
                            $price = $cart->price * $cart->pty;
                            $total += $price;
                        @endphp
                        <tr>
                            <td class="column-2">
                                <div class="how-itemcart1">
                                    <a href="/san-pham/{{ $cart->product->id}}-{{ Str::slug($cart->product->name, '-') }}.html"><img src="{{ $cart->product->thumb }}" alt="IMG" style="width: 100px"></a>
                                </div>
                            </td>
                            <td class="column-3"><a href="/san-pham/{{ $cart->product->id}}-{{ Str::slug($cart->product->name, '-') }}.html" style="color: black">{{ $cart->product->name }}</a></td>
                            <td class="column-4">{{ number_format($cart->price, 0, '', '.') }}</td>
                            <td class="column-5">{{ $cart->pty }}</td>
                            <td class="column-6">{{ number_format($price, 0, '', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right"><strong>Tổng Tiền</strong></td>
                        <td colspan="1">{{ number_format($total, 0, '', '.') }}</td>
                    </tr>
                    @if ($customer->voucher != null)
                        <tr>
                            <td colspan="4" class="text-right"><strong>Giảm giá</strong></td>
                            <td>
                                @if ($customer->vouchers[0]['condition']==1)
                                    {{number_format( ($total * $customer->vouchers[0]['number']) /100), 0, '.', '.'}}
                                @elseif ($customer->vouchers[0]['condition']==2)
                                    {{number_format($customer->vouchers[0]['number'], 0, '', '.')}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Tổng tiền đã giảm</strong></td>
                            <td>
                                @if ($customer->vouchers[0]['condition']==1)
                                    {{number_format( $total -= ($total * $customer->vouchers[0]['number']) /100), 0, '.', '.'}}
                                @elseif ($customer->vouchers[0]['condition']==2)
                                    {{number_format($total -= $customer->vouchers[0]['number'], 0, '', '.')}}
                                @endif
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="4" class="text-right"><strong>Giảm giá</strong></td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Tổng tiền đã giảm</strong></td>
                            <td>{{ number_format($total, 0, '', '.') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <button class="btn btn-primary mb-4"><a style="color: white" href="{{ URL::previous() }}">Quay lại</a></button>
        </div>
        
    </div>
@endsection