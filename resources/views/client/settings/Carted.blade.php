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
                <div role="tabpanel" class="tab-pane active " id="Reply">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">#</th>
                                    <th class="column-1">Hình ảnh</th>
                                    <th class="column-2"style="white-space:nowrap">Tên sản phẩm</th>
                                    <th class="column-3"style="white-space:nowrap">Số lượng</th>
                                    <th class="column-4"style="white-space:nowrap">Tổng tiền</th>
                                    <th class="column-5"style="white-space:nowrap">Thời gian</th>
                                    <th class="column-6">&nbsp;</th>
                                </tr>
                                
                                @foreach ($carts as $key => $item)
                                
                                    @if ($item['active'] == 2)
                                        @php
                                        $total = 0;
                                        $price = $item['price'] * $item['quantity'];
                                        if ($item['customer_voucher'] != NULL) {
                                            if ($item['customer_vouchers'][0]['condition'] == 1 ) {
                                                $total_sale = ($price * $item['customer_vouchers'][0]['number'])/100;
                                                $price -= $total_sale; 
                                                $test= $item['customer_id'];
                                            }
                                            elseif ($item['customer_vouchers'][0]['condition']==2) {
                                                if($test != $item['customer_id']){
                                                    $price -= $item['customer_vouchers'][0]['number'];
                                                    $test= $item['customer_id'];
                                                }
                                            }
                                        }
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ $item['customer_id'] }}
                                            </td>
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <a href="/san-pham/{{ $item['id'] }}-{{ Str::slug($item['name'], '-') }}.html"><img src="{{ $item['thumb'] }}" alt="IMG" style="width: 100px"></a>
                                                </div>
                                            </td>
                                            <td class="column-2" style="white-space:nowrap"><a href="/san-pham/{{ $item['id'] }}-{{ Str::slug($item['name'], '-') }}.html" style="color:black;">{{ $item['name'] }}</a></td>
                                            <td class="column-4" style="white-space:nowrap">{{ $item['quantity'] }}</td>
                                            <td class="column-3"style="white-space:nowrap">{{ number_format($price, 0, '', '.') }}</td>
                                            <td class="column-5"style="white-space:nowrap">{{$item['time']}}</td>
                                            <td class="column-6" style="white-space:nowrap">
                                                <a class="btn btn-danger btn-sm" href="/setting/delete/{{$item['customer_id']}}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div role="tabpanel" class="tab-pane " id="GH">
                    <div class="table-responsive-sm table-responsive-lg">
                        <table class="table">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">#</th>
                                    <th class="column-1">Hình ảnh</th>
                                    <th class="column-2"style="white-space:nowrap">Tên sản phẩm</th>
                                    <th class="column-3"style="white-space:nowrap">Số lượng</th>
                                    <th class="column-4"style="white-space:nowrap">Tổng tiền</th>
                                    <th class="column-5"style="white-space:nowrap">Thời gian</th>
                                </tr>
                        
                                @foreach ($carts as $key => $item)
                                
                                    @if ($item['active'] == 3)
                                        @php
                                        $total = 0;
                                        $price = $item['price'] * $item['quantity'];
                                        if ($item['customer_voucher'] != NULL) {
                                            if ($item['customer_vouchers'][0]['condition'] == 1 ) {
                                                $total_sale = ($price * $item['customer_vouchers'][0]['number'])/100;
                                                $price -= $total_sale; 
                                            }
                                            elseif ($item['customer_vouchers'][0]['condition']==2) {
                                                if($test != $item['customer_id']){
                                                    $price -= $item['customer_vouchers'][0]['number'];
                                                    $test= $item['customer_id'];
                                                }
                                            }
                                        }
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ $item['customer_id'] }}
                                            </td>
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <a href="/san-pham/{{ $item['id'] }}-{{ Str::slug($item['name'], '-') }}.html"><img src="{{ $item['thumb'] }}" alt="IMG" style="width: 100px"></a>
                                                </div>
                                            </td>
                                            <td class="column-2" style="white-space:nowrap"><a href="/san-pham/{{ $item['id'] }}-{{ Str::slug($item['name'], '-') }}.html" style="color:black;">{{ $item['name'] }}</a></td>
                                            <td class="column-4" style="white-space:nowrap">{{ $item['quantity'] }}</td>
                                            <td class="column-3"style="white-space:nowrap">{{ number_format($price, 0, '', '.') }}</td>
                                            <td class="column-5"style="white-space:nowrap">{{$item['time']}}</td>
                                            <td class="column-6" style="white-space:nowrap">
                                                <a class="btn btn-danger btn-sm" href="/setting/delete/{{$item['customer_id']}}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                        
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane " id="DaGiao">
                    <div class="table-responsive-sm table-responsive-lg">
                        <table class="table">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">#</th>
                                    <th class="column-1">Hình ảnh</th>
                                    <th class="column-2"style="white-space:nowrap">Tên sản phẩm</th>
                                    <th class="column-3"style="white-space:nowrap">Số lượng</th>
                                    <th class="column-4"style="white-space:nowrap">Tổng tiền</th>
                                    <th class="column-5"style="white-space:nowrap">Thời gian</th>
                                </tr>
                        
                                @foreach ($carts as $key => $item)
                                
                                    @if ($item['active'] == 4)
                                        @php
                                        $total = 0;
                                        $price = $item['price'] * $item['quantity'];
                                        if ($item['customer_voucher'] != NULL) {
                                            if ($item['customer_vouchers'][0]['condition'] == 1 ) {
                                                $total_sale = ($price * $item['customer_vouchers'][0]['number'])/100;
                                                $price -= $total_sale; 
                                            }
                                            elseif ($item['customer_vouchers'][0]['condition']==2) {
                                                if($test != $item['customer_id']){
                                                    $price -= $item['customer_vouchers'][0]['number'];
                                                    $test= $item['customer_id'];
                                                }
                                            }
                                        }
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ $item['customer_id'] }}
                                            </td>
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <a href="/san-pham/{{ $item['id'] }}-{{ Str::slug($item['name'], '-') }}.html"><img src="{{ $item['thumb'] }}" alt="IMG" style="width: 100px"></a>
                                                </div>
                                            </td>
                                            <td class="column-2" style="white-space:nowrap"><a href="/san-pham/{{ $item['id'] }}-{{ Str::slug($item['name'], '-') }}.html" style="color:black;">{{ $item['name'] }}</a></td>
                                            <td class="column-4" style="white-space:nowrap">{{ $item['quantity'] }}</td>
                                            <td class="column-3"style="white-space:nowrap">{{ number_format($price, 0, '', '.') }}</td>
                                            <td class="column-5"style="white-space:nowrap">{{$item['time']}}</td>
                                            <td class="column-6" style="white-space:nowrap">
                                                <a class="btn btn-danger btn-sm" href="/setting/delete/{{$item['customer_id']}}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                        
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane " id="Ca">
                    <div class="table-responsive-sm table-responsive-lg">
                        <table class="table">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">#</th>
                                    <th class="column-1">Hình ảnh</th>
                                    <th class="column-2"style="white-space:nowrap">Tên sản phẩm</th>
                                    <th class="column-3"style="white-space:nowrap">Số lượng</th>
                                    <th class="column-4"style="white-space:nowrap">Tổng tiền</th>
                                    <th class="column-5"style="white-space:nowrap">Thời gian</th>
                                </tr>
                        
                                @foreach ($carts as $key => $item)
                                
                                @if ($item['active'] == 1)
                                    @php
                                    $total = 0;
                                    $price = $item['price'] * $item['quantity'];
                                    if ($item['customer_voucher'] != NULL) {
                                        if ($item['customer_vouchers'][0]['condition'] == 1 ) {
                                            $total_sale = ($price * $item['customer_vouchers'][0]['number'])/100;
                                            $price -= $total_sale; 
                                        }
                                        elseif ($item['customer_vouchers'][0]['condition']==2) {
                                            if($test != $item['customer_id']){
                                                $price -= $item['customer_vouchers'][0]['number'];
                                                $test= $item['customer_id'];
                                            }
                                        }
                                    }
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $item['customer_id'] }}
                                        </td>
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <a href="/san-pham/{{ $item['id'] }}-{{ Str::slug($item['name'], '-') }}.html"><img src="{{ $item['thumb'] }}" alt="IMG" style="width: 100px"></a>
                                            </div>
                                        </td>
                                        <td class="column-2" style="white-space:nowrap"><a href="/san-pham/{{ $item['id'] }}-{{ Str::slug($item['name'], '-') }}.html" style="color:black;">{{ $item['name'] }}</a></td>
                                        <td class="column-4" style="white-space:nowrap">{{ $item['quantity'] }}</td>
                                        <td class="column-3"style="white-space:nowrap">{{ number_format($price, 0, '', '.') }}</td>
                                        <td class="column-5"style="white-space:nowrap">{{$item['time']}}</td>
                                        <td class="column-6" style="white-space:nowrap">
                                            <a class="btn btn-danger btn-sm" href="/setting/delete/{{$item['customer_id']}}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection