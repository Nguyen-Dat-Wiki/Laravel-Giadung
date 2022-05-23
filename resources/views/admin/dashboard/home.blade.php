@extends('admin.index')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Sản phẩm</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($allproduct)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-last pl-3">
                <div class="content">
                    <span>
                        <a href="{{route('allproduct')}}" >Danh sách sản phẩm
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- card người dùng -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Tài khoản người dùng</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($alluser)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-last pl-3">
                <div class="content">
                    <span>
                        <a href="{{route('alluser')}}" >Danh sách người dùng
                        <i class="fa fa-arrow-circle-right"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{-- card tổng đơn --}}

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Tổng đơn hàng</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($allcustomer)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-last pl-3">
                <div class="content">
                    <span>
                        <a href="{{route('allcustomer')}}">Danh sách đơn hàng</a>
                        <i class="fa fa-arrow-circle-right"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- card yêu cầu xử lý --}}
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Yêu cầu cần xử lý</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($customer)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-last pl-3">
                <div class="content">
                    <span>
                        <a href="{{route('request',[2])}}" >Danh sách đơn hàng
                        <i class="fa fa-arrow-circle-right"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Đơn hàng đang vận chuyển</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($customer3)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-last pl-3">
                <div class="content">
                    <span>
                        <a href="{{route('request',[3])}}" >Danh sách đơn hàng
                        <i class="fa fa-arrow-circle-right"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Đơn hàng đã hoàn thành</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($customer4)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-last pl-3">
                <div class="content">
                    <span>
                        <a href="{{route('request',[4])}}" >Danh sách đơn hàng
                        <i class="fa fa-arrow-circle-right"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Đơn hàng đã bị huỷ </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($customer1)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="card-last pl-3">
                <div class="content">
                    <span>
                        <a href="{{route('request',[1])}}" >Danh sách đơn hàng
                        <i class="fa fa-arrow-circle-right"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <hr>
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
                        @foreach ($customer->carts as $item)
                            @php
                            $total2=0;
                            $price = $item->price * $item->pty;
                            $total2+= $price;
                            if ($customer->voucher != NULL) {
                                if ($customer->vouchers[0]['condition']==1) {
                                    $total_sale = ($total2 * $customer->vouchers[0]['number'])/100;
                                    $total2 -= $total_sale;
                                }
                                elseif ($customer->vouchers[0]['condition']==2) {
                                    $total2 -= $customer->vouchers[0]['number'];
                                }
                            }
                            $total+=$total2;
                            @endphp
                        @endforeach
                    @endforeach
                @endif
                
            </div>
            <div class="float-right mr-4 mb-4">
                <span>Tổng tiền: </span>&nbsp;<b>{{number_format($total, 0, '', '.')}}đ</b>
            </div>
        </form>
    </div>
    <div class="card-header">
        <h3 class="card-title">Danh sách đơn hàng đã đang hoàn thành</h3>
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
                    <th class="column-4">Trạng thái 
                        @if(request()->getQueryString() == 'active=desc')
                            <a href="{{request()->url()}}?active=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'active=asc')
                            <a href="{{request()->url()}}?active=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?active=asc"> <i class="fas fa-sort"></i></a>
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
                        $total=0;
                        foreach ($customer->carts as $key => $value) {
                            $price = $value->price * $value->pty;
                            $total += $price;
                        }
                        if ($customer->voucher != NULL) {
                            if ($customer->vouchers[0]['condition']==1) {
                                $total_sale = ($total * $customer->vouchers[0]['number'])/100;
                                $total -= $total_sale;
                            }
                            elseif ($customer->vouchers[0]['condition']==2) {
                                $total -= $customer->vouchers[0]['number'];
                            }
                        }
                    @endphp
                    <tr>
                        <th scope="row" ><a href="/admin/customers/view/{{ $customer->id }}" style="color: black">{{$customer->id}}</a></th>
                        <td style="white-space:nowrap">{{ $customer->name }}</td>
                        <td style="white-space:nowrap">{{ $customer->address }}</td>
                        <td style="white-space:nowrap">{!! \App\Helpers\Helper::activeCustomer($customer->active) !!}</td>
                        <td style="white-space:nowrap">{{ date_format($customer->created_at,"d-m-Y") }}</td>
                        <td style="white-space:nowrap">{{ number_format($total, 0, '', '.') }}</td>
                    </tr>
                @endforeach
            {{$carts->appends(request()->query())->onEachSide(1)->links()}}

            @endif
        </table>
    </div>

@endsection