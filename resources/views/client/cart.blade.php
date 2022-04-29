@extends('client.index')

@section('head')
    
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
            <main class="cart border mb-4 d-flex justify-content-between">
                <div class="main-left ">
                    <form action="" method="post">
                        <h3 class="mb-0 mt-4">Giỏ hàng của bạn</h3>
                        <hr class="mt-3">
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
                                        <td>{{$product->name}}</td>
                                        <td><input type="number" class="num_product" name="num_product[{{ $product->id }}]" value="{{$carts[$product->id]}}" min="1" max="100"></td>
                                        <td>{{number_format($priceEnd)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mb-4">
                            <button type="submit" id="autoclick" hidden class=" btn-cart btn btn-primary" name="thanhtoan" formaction="/update-cart">Cập nhật</button>
                            @csrf
                        </div>
                        <div class="borderMoney border d-flex justify-content-between">
                            <span class="ml-5 font-weight-bold">Tổng tiền:</span>
                            <span class=" font-weight-bold">{{ number_format($total, 0, '', '.')  }}</span>
                        </div>
                    </form>
                </div>
                <div class="main-right mb-4">
                    <h3 class="mb-0 mt-4">Hình thức thanh toán</h3>
                    <hr class="mt-3">
                    <div class="FormHinhThuc mb-4">
                        <ul class="ChoseHinhThuc">
                            <li>
                                <input type="radio" id="taicho" name="HinhThuc">
                                <label for="taicho">
                                    <div class="border ">Thanh toán trực tiếp tại cửa hàng</div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="MV" name="HinhThuc">
                                <label for="MV">
                                    <div class="border ">Thanh toán tại điểm giao hàng</div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="Chuyenkhoan" name="HinhThuc">
                                <label for="Chuyenkhoan">
                                    <div class="border ">Thanh toán bằng chuyển khoản</div>
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
                    <button type="submit" class="btn-cart btn btn-primary btn-lg btn-block" name="thanhtoan" >Thanh toán </button>
                </div>
            </main>
        @else
            <h2 class="text-center">Giỏ hàng trống</h2>
        @endif

    </form>
</div>
@endsection