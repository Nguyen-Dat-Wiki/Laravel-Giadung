<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$heading}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .brand-section{
           background-color: #0d1033;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding: 8px 0;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        
       
    </style>
</head>
<body>

    <div class="">
        <div class="brand-section">
            <div class="row">
                <div class="">
                    <h2 class="text-white">HAGO
                    </h2>
                </div>
                <div class="float-right">
                </div>
            </div>
        </div>

        <div class="body-section" >
            <div class="row" style="padding-left: 10px">
                <div class="">
                    <h3 class="heading">ID Order: {{$customer->id}}</h3>
                    <p class="sub-heading">Tracking No. hago2025 </p>
                    <p class="sub-heading">Order Date: {{date_format($customer->created_at,'d-m-y')}} </p>
                    <p class="sub-heading">Email Address: {{$customer->address}} </p>
                </div>
                <div class="">
                    <p class="sub-heading">Full Name:  {{$customer->name}}</p>
                    <p class="sub-heading">Address:   {{$customer->address}}</p>
                    <p class="sub-heading">Phone Number:  {{$customer->phone}} </p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Order Detail</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th class="w-20">Gỉá</th>
                        <th class="w-20">Số lương</th>
                        <th class="w-20">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach($carts as $key => $cart)
                    @php
                        $price = $cart->price * $cart->pty;
                        $total += $price;
                    @endphp
                    <tr>
                        <td class="column-1">{{ $cart->product->name }}</td>
                        <td class="column-2">{{ number_format($cart->price, 0, '', '.') }}</td>
                        <td class="column-3">{{ $cart->pty }}</td>
                        <td class="column-4">{{ number_format($price, 0, '', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right">Tạm tính</td>
                        <td>{{number_format($total, 0, '', '.')}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Phí ship</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Tổng tiền</td>
                        <td> {{number_format($total, 0, '', '.')}}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3 class="heading">Payment Status: Paid</h3>
            <h3 class="heading">Payment Mode: {{$customer->payment}}</h3>
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2022 - Hago. All rights reserved. 
                <a href="http://dientu.webhop.me" class="float-right">www.dientu.webhop.me</a>
            </p>
        </div>      
    </div>      

</body>
</html>