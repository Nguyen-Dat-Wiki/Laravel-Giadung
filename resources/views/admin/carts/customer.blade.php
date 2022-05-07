@extends('admin.index')

@section('content')
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
                <th>Email
                    @if(request()->getQueryString() == 'mail=desc')
                        <a href="{{request()->url()}}?mail=asc"> <i class="fas fa-sort-up"></i></a>
                    @elseif(request()->getQueryString() == 'mail=asc')
                        <a href="{{request()->url()}}?mail=desc"> <i class="fas fa-sort-down"></i></a>
                    @else
                        <a href="{{request()->url()}}?mail=asc"> <i class="fas fa-sort"></i></a>
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
                <th style="width: 100px">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $key => $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{!! \App\Helpers\Helper::activeCustomer($customer->active) !!}</td>
                    <td>{{ $customer->created_at }}</td>
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


