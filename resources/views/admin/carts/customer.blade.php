@extends('admin.index')

@section('content')

<form action="{{route('searchcustomer')}}" method="GET">
    <div class="row mx-0 my-2">
        <div class="col-lg-5">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm số điện thoại">
                <button class="btn btn-outline-secondary" type="submit" >Tìm kiếm</button>
            </div>
        </div>
        
        <div class="col-lg-3">
            <div class="form-group d-flex align-items-center">
                <label class="col-auto">Trạng thái</label>
                <select class="form-control" name="actives">
                    <option value="0" >Chọn trạng thái</option>
                    <option value="1" >Bị huỷ</option>
                    <option value="2" >Chờ xác nhận</option>
                    <option value="3" >Đang vận chuyển</option>
                    <option value="4" >Đã hoàn thành</option>
                </select>
            </div>
        </div>
    </div>
</form>


<div class="table-responsive-sm table-responsive    ">
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID
                @if(request()->getQueryString() == 'id=desc')
                    <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'id=asc')
                    <a href="{{request()->url()}}?id=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Tên Khách Hàng
                @if(request()->getQueryString() == 'name=desc')
                    <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'name=asc')
                    <a href="{{request()->url()}}?name=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Số Điện Thoại
                @if(request()->getQueryString() == 'phone=desc')
                    <a href="{{request()->url()}}?phone=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'phone=asc')
                    <a href="{{request()->url()}}?phone=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?phone=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th>Trạng thái
                @if(request()->getQueryString() == 'active=desc')
                    <a href="{{request()->url()}}?active=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'active=asc')
                    <a href="{{request()->url()}}?active=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?active=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th>Ngày Đặt hàng
                @if(request()->getQueryString() == 'created_at=desc')
                    <a href="{{request()->url()}}?created_at=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'created_at=asc')
                    <a href="{{request()->url()}}?created_at=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?created_at=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th>Tổng tiền</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $key => $customer)
        
            @php
                $total=0;
                foreach ($customer->carts as $key => $value) {
                    $price = $value->price * $value->pty;
                    $total += $price;
                }
                if ($customer->voucher != NULL) {
                        if ($customer->vouchers[0]['condition']==1) {
                            $total -= ($total * $customer->vouchers[0]['number'])/100;
                        }
                        elseif ($customer->vouchers[0]['condition']==2) {
                            $total -= $customer->vouchers[0]['number'];
                        }
                    }
            @endphp
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{!! \App\Helpers\Helper::activeCustomer($customer->active) !!}</td>
                <td>{{ $customer->created_at }}</td>
                <td>{{ number_format($total, 0, '', '.') }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $customer->id }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow({{ $customer->id }}, '/admin/customers/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="card-footer clearfix">
    {{$customers->appends(request()->query())->onEachSide(1)->links()}}
</div>
@endsection


