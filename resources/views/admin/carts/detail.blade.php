@extends('admin.index')

@section('content')
    <div class="row m-0">
        <div class="customer mt-3">
            <ul>
                <li>Tên khách hàng: <strong>{{ $customer->name }}</strong></li>
                <li>Số điện thoại: <strong>{{ $customer->phone }}</strong></li>
                <li>Địa chỉ: <strong>{{ $customer->address }}</strong></li>
                <li>Email: <strong>{{ $customer->email }}</strong></li>
                <li>Hình thức thanh toán: <strong>@switch($customer->payment)
                    @case('Transfer Payments Momo')
                        Thanh toán momo
                        @break
                    @case('Transfer Payments Vnpay')
                        Thanh toán Vnpay
                    @break
                    @default
                        Thanh toán tiền mặt
                        
                @endswitch</strong></li>
                <li>Trạng thái: <strong>{!! \App\Helpers\Helper::activeCustomer($customer->active) !!}</strong></li>
                <li>Ghi chú: <strong>{{ $customer->content }}</strong></li>
            </ul>
        </div>
        @if ($customer->active == 3 || $customer->active == 4)
            <div class="mx-auto mt-3">
                <a href="{{$customer->id}}/print" class="btn btn-primary">Print</a>
            </div>
        @endif
    </div>

    <div class="carts">
        @php $total = 0; @endphp
        <div class="table-responsive-sm table-responsive-lg">
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
                                <a href="/san-pham/{{ $cart->product->id}}-{{ Str::slug($cart->product->name, '-') }}.html"><img src="{{ $cart->product->thumb }}" alt="IMG" style="width: 100px"></a>
                            </div>
                        </td>
                        <td class="column-2"><a href="/san-pham/{{ $cart->product->id}}-{{ Str::slug($cart->product->name, '-') }}.html" style="color: black">{{ $cart->product->name }}</a></td>
                        <td class="column-3">{{ number_format($cart->price, 0, '', '.') }}</td>
                        <td class="column-4">{{ $cart->pty }}</td>
                        <td class="column-5">{{ number_format($price, 0, '', '.') }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="4" class="text-right"><strong>Tổng Tiền</strong></td>
                        <td>{{ number_format($total, 0, '', '.') }}</td>
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
        </div>
        
        <div class="col-md-6">
            @if ($customer->active == 2 || $customer->active == 3)
                <form action="" method="post">
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control" name="actives">
                            @foreach ($actives as $item)
                                <option value="{{$item->id}}" {!! ($customer->active == $item->id) ? 'selected' : '' ; !!}>{{$item->name}}</option>
                            @endforeach
                            <input type="text" hidden name="customer_id" value="{{$customer->id}}">
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Xác nhận</button>
                        @csrf
                    </div>
                </form>
            @endif
        </div>
        
    </div>
@endsection


