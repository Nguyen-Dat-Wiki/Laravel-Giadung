@extends('admin.index')

@section('content')
    <div class="customer mt-3">
        <ul>
            <li>Tên khách hàng: <strong>{{ $customer->name }}</strong></li>
            <li>Số điện thoại: <strong>{{ $customer->phone }}</strong></li>
            <li>Địa chỉ: <strong>{{ $customer->address }}</strong></li>
            <li>Email: <strong>{{ $customer->email }}</strong></li>
            <li>Ghi chú: <strong>{{ $customer->content }}</strong></li>
        </ul>
    </div>

    <div class="carts">
        @php $total = 0; @endphp
        <table class="table">
            <tbody>
            <tr class="table_head">
                <th class="column-1">Hình ảnh</th>
                <th class="column-2">Tên sản phẩm</th>
                <th class="column-3">Giá</th>
                <th class="column-4">Số lượng</th>
                <th class="column-5">Tổng tiền</th>
            </tr>

            @foreach($carts as $key => $cart)
                @php
                    $price = $cart->price * $cart->pty;
                    $total += $price;
                @endphp
                <tr>
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="{{ $cart->product->thumb }}" alt="IMG" style="width: 100px">
                        </div>
                    </td>
                    <td class="column-2">{{ $cart->product->name }}</td>
                    <td class="column-3">{{ number_format($cart->price, 0, '', '.') }}</td>
                    <td class="column-4">{{ $cart->pty }}</td>
                    <td class="column-5">{{ number_format($price, 0, '', '.') }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="4" class="text-right">Tổng Tiền</td>
                    <td>{{ number_format($total, 0, '', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection


