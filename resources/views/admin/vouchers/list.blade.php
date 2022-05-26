@extends('admin.index')

@section('content')
<div class="table-responsive table-responsive-lg">
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
            <th>Tên voucher
                @if(request()->getQueryString() == 'name=desc')
                    <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'name=asc')
                    <a href="{{request()->url()}}?name=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th>Mã voucher
                @if(request()->getQueryString() == 'code=desc')
                    <a href="{{request()->url()}}?code=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'code=asc')
                    <a href="{{request()->url()}}?code=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?code=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Số lượng

                @if(request()->getQueryString() == 'quantity=desc')
                    <a href="{{request()->url()}}?quantity=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'quantity=asc')
                    <a href="{{request()->url()}}?quantity=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?quantity=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Hình thức

                @if(request()->getQueryString() == 'Payment=desc')
                    <a href="{{request()->url()}}?Payment=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'Payment=asc')
                    <a href="{{request()->url()}}?Payment=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?Payment=asc"> <i class="fas fa-sort"></i></a>
                @endif
            </th>
            <th>Giảm theo 
                @if(request()->getQueryString() == 'condition=desc')
                    <a href="{{request()->url()}}?condition=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'condition=asc')
                    <a href="{{request()->url()}}?condition=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?condition=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th>Ngày bắt đầu
                @if(request()->getQueryString() == 'time_start=desc')
                    <a href="{{request()->url()}}?time_start=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'time_start=asc')
                    <a href="{{request()->url()}}?time_start=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?time_start=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th>Ngày kết thúc
                @if(request()->getQueryString() == 'time_end=desc')
                    <a href="{{request()->url()}}?time_end=asc"> <i class="fas fa-sort-up"></i></a>
                @elseif(request()->getQueryString() == 'time_end=asc')
                    <a href="{{request()->url()}}?time_end=desc"> <i class="fas fa-sort-down"></i></a>
                @else
                    <a href="{{request()->url()}}?time_end=asc"> <i class="fas fa-sort"></i></a>
                @endif

            </th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Vouchers as $key => $Voucher)
            <tr>
                <td>{{ $Voucher->id }}</td>
                <td>{{ $Voucher->name }}</td>
                <td>{{ $Voucher->code }}</td>
                <td>{{ $Voucher->quantity }}</td>
                <td>{!! \App\Helpers\Helper::Payment($Voucher->Payment) !!}</td>
                <td>{!! \App\Helpers\Helper::SaleVoucher($Voucher->condition) !!}</td>
                <td>{{ date('d-m-Y', strtotime($Voucher->time_start)) }}</td>
                <td>{{date('d-m-Y', strtotime($Voucher->time_end)) }}</td>
                <td>{!! \App\Helpers\Helper::CheckTime($Voucher->time_start,$Voucher->time_end) !!}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/vouchers/edit/{{ $Voucher->id }}">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="card-footer clearfix">
    {{$Vouchers->appends(request()->query())->onEachSide(1)->links()}}
</div>
@endsection