@extends('admin.index')

@section('content')
    <div class="">
        <form action="" method="post">
            <div class="row mx-3 my-3 ">
                <div class="mr-4">
                    <input type="datetime-local" value="{!! isset($start)? $start : date('Y-m-d').'T00:00' !!}" name="start" id="">
                </div>
                <div class="">
                    <input type="datetime-local" value="{!! isset($end)? $end : date('Y-m-d').'T12:00' !!}" name="end" id="">
                    
                </div>
                <div class="ml-4">
                    <button type="submit">Lọc</button>
                    @csrf
                </div>
                <div class="ml-auto">
                    <a class="btn btn-primary" href="/admin/export">Export Excel</a>
                </div>
                @php $total = 0 @endphp
                
                @if (isset($carts))
                    @foreach($carts as $key => $customer)
                        @php
                        $price = $customer->carts[0]['price'] * $customer->carts[0]['pty'];
                        $total += $price;
                        @endphp
                    @endforeach
                @endif
                
            </div>
            <div class="float-right mr-4 mb-4">
                <span>Tổng tiền: </span>&nbsp;<b>{{number_format($total, 0, '', '.')}}đ</b>
            </div>
        </form>
    </div>
    
    <div class="content table-responsive table-responsive-lg">
        <table class="table table-bordered " >
            <thead>
                <tr class="table_head">
                    <th class="column-1">STT 
                        @if(request()->getQueryString() == 'id=desc')
                            <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'id=asc')
                            <a href="{{request()->url()}}?id=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort"></i></a>
                        @endif 
                    </th>
                    <th class="column-2">Tên 
                        @if(request()->getQueryString() == 'name=desc')
                            <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'name=asc')
                            <a href="{{request()->url()}}?name=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort"></i></a>
                        @endif 
                    <th class="column-3">Địa chỉ 
                        @if(request()->getQueryString() == 'address=desc')
                            <a href="{{request()->url()}}?address=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'address=asc')
                            <a href="{{request()->url()}}?address=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?address=asc"> <i class="fas fa-sort"></i></a>
                        @endif 
                    <th class="column-4">Email 
                        @if(request()->getQueryString() == 'email=desc')
                            <a href="{{request()->url()}}?email=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'email=asc')
                            <a href="{{request()->url()}}?email=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?email=asc"> <i class="fas fa-sort"></i></a>
                        @endif 
                    <th class="column-5">Ngày 
                        @if(request()->getQueryString() == 'created_at=desc')
                            <a href="{{request()->url()}}?created_at=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'created_at=asc')
                            <a href="{{request()->url()}}?created_at=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?created_at=asc"> <i class="fas fa-sort"></i></a>
                        @endif 
                    <th class="column-6">Tổng tiền</th>
                </tr>
            </thead>
            @if (isset($carts))
                @foreach($carts as $key => $customer)
                    @php
                        $total = 0;
                        $price = 0;
                        $price = $customer->carts[0]['price'] * $customer->carts[0]['pty'];
                        $total += $price;
                    @endphp
                    <tr>
                        <th scope="row" >{{$customer->id}}</th>
                        <td style="white-space:nowrap">{{ $customer->name }}</td>
                        <td style="white-space:nowrap">{{ $customer->address }}</td>
                        <td style="white-space:nowrap">{{ $customer->email }}</td>
                        <td style="white-space:nowrap">{{ date_format($customer->created_at,"d-m-Y") }}</td>
                        <td style="white-space:nowrap">{{ number_format($total, 0, '', '.') }}</td>
                    </tr>
                @endforeach
            {{$carts->appends(request()->query())->onEachSide(1)->links()}}

            @endif
        </table>
    </div>

@endsection