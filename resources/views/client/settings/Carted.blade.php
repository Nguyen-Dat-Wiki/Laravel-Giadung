@extends('client.index')

@section('head')
    <script src="/asset/js/tab.js"></script>
@endsection

@section('content_new')
    @include('client.layouts.sidebar')
    <div class="carted">
        <div role="tabpanel" class="tab-pane" id="DH">
            <h3>Đơn hàng của tôi</h3>
            <hr>
            <ul class="nav-tabs nav navDH" role="tablist">
                <li role="presentation"class="active"><a href="#Reply" class="text-dark" role="tab" data-toggle="tab">Chờ xác nhận</a></li>
                <li role="presentation"><a href="#GH" class="text-dark" a role="tab" data-toggle="tab">Đang giao</a></li>
                <li role="presentation"><a href="#DaGiao" class="text-dark" role="tab" data-toggle="tab">Đã giao</a></li>
                <li role="presentation"><a href="#Ca" class="text-dark" role="tab" data-toggle="tab">Đã hủy</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="Reply">
                    <table class="table">
                        <tbody>
                            <tr class="table_head">
                                <th class="column-1">Hình ảnh</th>
                                <th class="column-2">Tên sản phẩm</th>
                                <th class="column-3">Số lượng</th>
                                <th class="column-4">Tổng tiền</th>
                                <th class="column-5">Thời gian</th>
                            </tr>
                            
                            @php $total = 0 @endphp
                            @foreach ($carts as $key => $item)
                                
                                @if ($item['active'] == 1)
                                    @php
                                    $price = $item['price'] * $item['quantity'];
                                    $total += $price;
                                    @endphp
                                    <tr>
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ $item['thumb'] }}" alt="IMG" style="width: 100px">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $item['name'] }}</td>
                                        <td class="column-4">{{ $item['quantity'] }}</td>
                                        <td class="column-3">{{ number_format($price, 0, '', '.') }}</td>
                                        <td class="column-5">{{$item['time']}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
                <div role="tabpanel" class="tab-pane " id="GH">
                    <table class="table">
                        <tbody>
                            <tr class="table_head">
                                <th class="column-1">Hình ảnh</th>
                                <th class="column-2">Tên sản phẩm</th>
                                <th class="column-3">Số lượng</th>
                                <th class="column-4">Tổng tiền</th>
                                <th class="column-5">Thời gian</th>
                            </tr>
                            
                            @php $total = 0 @endphp
                            @foreach ($carts as $key => $item)
                                
                                @if ($item['active'] == 2)
                                    @php
                                    $price = $item['price'] * $item['quantity'];
                                    $total += $price;
                                    @endphp
                                    <tr>
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ $item['thumb'] }}" alt="IMG" style="width: 100px">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $item['name'] }}</td>
                                        <td class="column-4">{{ $item['quantity'] }}</td>
                                        <td class="column-3">{{ number_format($price, 0, '', '.') }}</td>
                                        <td class="column-5">{{$item['time']}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane " id="DaGiao">
                    <table class="table">
                        <tbody>
                            <tr class="table_head">
                                <th class="column-1">Hình ảnh</th>
                                <th class="column-2">Tên sản phẩm</th>
                                <th class="column-3">Số lượng</th>
                                <th class="column-4">Tổng tiền</th>
                                <th class="column-5">Thời gian</th>
                            </tr>
                            
                            @php $total = 0 @endphp
                            @foreach ($carts as $key => $item)
                                
                                @if ($item['active'] == 3)
                                    @php
                                    $price = $item['price'] * $item['quantity'];
                                    $total += $price;
                                    @endphp
                                    <tr>
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ $item['thumb'] }}" alt="IMG" style="width: 100px">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $item['name'] }}</td>
                                        <td class="column-4">{{ $item['quantity'] }}</td>
                                        <td class="column-3">{{ number_format($price, 0, '', '.') }}</td>
                                        <td class="column-5">{{$item['time']}}</td>
                                    </tr>
                                @endif
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane " id="Ca">
                    <table class="table">
                        <tbody>
                            <tr class="table_head">
                                <th class="column-1">Hình ảnh</th>
                                <th class="column-2">Tên sản phẩm</th>
                                <th class="column-3">Số lượng</th>
                                <th class="column-4">Tổng tiền</th>
                                <th class="column-5">Thời gian</th>
                            </tr>
                            
                            @php $total = 0 @endphp
                            @foreach ($carts as $key => $item)
                                
                                @if ($item['active'] == 0)
                                    @php
                                    $price = $item['price'] * $item['quantity'];
                                    $total += $price;
                                    @endphp
                                    <tr>
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ $item['thumb'] }}" alt="IMG" style="width: 100px">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $item['name'] }}</td>
                                        <td class="column-4">{{ $item['quantity'] }}</td>
                                        <td class="column-3">{{ number_format($price, 0, '', '.') }}</td>
                                        <td class="column-5">{{$item['time']}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection