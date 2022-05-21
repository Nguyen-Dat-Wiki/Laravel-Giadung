@extends('client.index')

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="/asset/js/coutry.js"></script>
@endsection

@section('content_new')
<div class="breadCrumbs">
    <div class="wrap-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="/"><span>Trang chủ</span></a></li>
            <li class="breadcrumb-item "><a class="text-decoration-none" href="/gio-hang"><span>Giỏ hàng</span></a></li>
        </ol>
    </div>
</div>
<div class="main-cart">
    <form action="/gio-hang" method="post">
        @if (count($products) != 0)
            <main class="cart border mb-4 d-flex justify-content-between flex-wrap">
                <div class="left col-lg-7 ">
                    <form action="" method="post">
                        <h3 class="mb-0 mt-4">Giỏ hàng của bạn</h3>
                        <hr class="mt-3">
                        <div class="table-responsive-sm table-responsive-lg">
                            <table class="table border">
                                <thead class="thead-light"> 
                                    <tr>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product )
                                        @php
                                            $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                            $priceEnd = $price * $carts[$product->id];
                                            $total += $priceEnd;
                                        @endphp
                                        <tr>
                                            <th scope="row"><a href="gio-hang/delete/{{$product->id}}"><img src="{{$product->thumb}}" width="100px" alt=""></a></th>
                                            <td><a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html" style="color: black">{{$product->name}}</a></td>
                                            <td>
                                                <input type="number" class="num_product" name="num_product[{{ $product->id }}]" value="{{$carts[$product->id]}}" min="1" max="{{$product->quantity}}">
                                            </td>
                                            <td>{{ number_format($priceEnd, 0, '', '.') }}đ</td>
                                        </tr>
                                        <input type="number" class="num_product_add" hidden value="{{$product->quantity}}">
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-4">
                            <button type="submit" id="autoclick" hidden class=" btn-cart btn btn-primary" name="thanhtoan" formaction="/update-cart">Cập nhật</button>
                            <input type="text" class="border rounded" style="padding:6px 12px" name="voucher"  placeholder="Nhập voucher (nếu có)"> <button class="btn-cart btn btn-primary" formaction="/add-voucher">Nhập voucher</button>
                            @csrf
                        </div>
                        <div class="borderMoney border">
                            <ul class="">
                                <li>
                                    <span class="ml-5 font-weight-bold">Tổng tiền:</span>
                                    <span class=" font-weight-bold">{{ number_format($total, 0, '', '.')  }}đ</span>
                                </li>
                                @if (Session::get('voucher'))
                                    <li>
                                        @foreach (Session::get('voucher') as $key => $item)
                                            @if ($item['voucher_condition']==1)
                                                    <span class="ml-5 font-weight-bold">Mã giảm:</span>
                                                    <span class="font-weight-bold">{{$item['voucher_number']}}%</span>
                                                </li>
                                                <li>
                                                    @php $total_sale = ($total*$item['voucher_number'])/100 @endphp    
                                                    <span class="ml-5 font-weight-bold">Tổng giảm:</span>
                                                    <span class="font-weight-bold">{{number_format($total_sale,0, '', '.')}}đ</span>
                                                </li>
                                                <li>
                                                    <span class="ml-5 font-weight-bold">Tổng đã giảm:</span> 
                                                    @php $total = ($total - $total_sale) @endphp    
                                                    <span class="font-weight-bold">{{number_format($total,0, '', '.')}}đ</span>
                                                </li>
                                            @elseif ($item['voucher_condition']==2)
                                                <li>
                                                    <span class="ml-5 font-weight-bold">Mã giảm:  </span>
                                                    @php $total_sale = ($item['voucher_number']) @endphp 
                                                    <span class="font-weight-bold">{{ number_format($total_sale,0, '', '.')}}</span>
                                                </li>
                                                <li>
                                                    <span class="ml-5 font-weight-bold">Tổng đã giảm:</span> 
                                                    @php $total = ($total - $total_sale) @endphp    
                                                    <span class="font-weight-bold">{{number_format($total,0, '', '.')}}đ</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </form>
                </div>
               
                <div class="right mb-4 col-lg-5">
                    <h3 class="mb-0 mt-4">Hình thức thanh toán</h3>
                    <hr class="mt-3">
                    <div class="FormHinhThuc mb-4">
                        <ul class="ChoseHinhThuc">
                            @php 
                                $voucher = Session::get('voucher') ;
                            @endphp
                            <li>
                                <input type="radio" id="MV" name="HinhThuc" value="Cash on Delivery" 
                                @php
                                    if (Session::get('voucher')!= null) {
                                        $voucher = Session::get('voucher');
                                        if($voucher[0]['voucher_payment']=='Cash on Delivery' ){
                                            echo 'checked';
                                        }
                                    }
                                @endphp>
                                <label for="MV">
                                    <div class="border ">Thanh toán tại điểm giao hàng</div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="Vnpay" name="HinhThuc" value="Transfer Payments Vnpay"
                                @php
                                    if (Session::get('voucher')!= null) {
                                        $voucher = Session::get('voucher');
                                        if($voucher[0]['voucher_payment']=='Transfer Payments Vnpay' ){
                                            echo 'checked';
                                        }
                                    }
                                @endphp>
                                <label for="Vnpay">
                                    <div class="border ">Thanh toán bằng Vnpay</div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="Momo" name="HinhThuc" value="Transfer Payments Momo" 
                                @php
                                    if (Session::get('voucher')!= null) {
                                        $voucher = Session::get('voucher');
                                        if($voucher[0]['voucher_payment']=='Transfer Payments Momo' ){
                                            echo 'checked';
                                        }
                                    }
                                @endphp>
                                <label for="Momo">
                                    <div class="border ">Thanh toán bằng Momo</div>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <h3 class="mb-0 mt-5">Thông tin giao hàng</h3>
                    <hr class="mt-3">
                    @include('client.layouts.alert')
                    <div class="FormThongTin">
                        <div class="row">
                            <div class="form-group col-6">
                                <input class="form-control form-control-lg" name="fullname" type="text" placeholder="Họ tên" autocomplete="off">
                            </div>
                            <div class="form-group col-6">
                                <input class="form-control form-control-lg" name="phonenumber" type="text" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="email" type="email" placeholder="Email">
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <select class="form-select form-control form-control-lg form-select-sm mb-3"  name="TP" id="city" aria-label=".form-select-sm">
                                    <option value="" selected>Tỉnh/Thành</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <select class="form-select form-control form-control-lg form-select-sm mb-3"  name="Quan" id="district" aria-label=".form-select-sm">
                                    <option value="" selected>Chọn quận huyện</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <select class="form-select form-control form-control-lg form-select-sm" name="Phuong" id="ward" aria-label=".form-select-sm">
                                    <option value="" selected>Chọn phường xã</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="address" type="text" placeholder="Địa chỉ">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-lg" height="500px" name="note" type="text" placeholder="Yêu cầu khác (Không bắt buộc)"></textarea>
                        </div>
                    </div>
                    <input type="text" name='total' hidden value="{{$total}}">
                    <input type="text" name="user_id" hidden value="{!!  isset(Auth::user()->id) ? Auth::user()->id : null !!}">
                    <button type="submit" class="btn-cart btn btn-primary btn-lg btn-block" id="thanhtoan" name="thanhtoan" >Thanh toán </button>
                    <button type="submit" class="btn-cart btn btn-primary btn-lg btn-block d-none" id="redirect" name="redirect" formaction="gio-hang/vnpay">Thanh toán Vnpay</button>
                    <button type="submit" class="btn-cart btn btn-primary btn-lg btn-block d-none" id="redirect2" name="redirect" formaction="gio-hang/momo">Thanh toán Momo</button>
                    @csrf
                </div>
            </main>
        @else
            @include('admin.layouts.alert')
            {{Session::forget('voucher')}}
            <h2 class="text-center">Giỏ hàng trống</h2>
        @endif

    </form>
</div>
@endsection