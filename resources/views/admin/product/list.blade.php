@extends('admin.index')

@section('content')
<div class="row">
    <form action="" method="POST" class=" col-lg-5">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Search name">
            <button class="btn btn-outline-secondary" type="submit" >search</button>
        </div>
        @csrf
    </form>
</div>

    <div class="table-responsive table-responsive-lg">
        <table class="table table-bordered">
            <thead>
                <tr  id="table">
                    <th style="width: 60px">ID
                        @if(request()->getQueryString() == 'id=desc')
                            <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'id=asc')
                            <a href="{{request()->url()}}?id=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?id=asc"> <i class="fas fa-sort"></i></a>
                        @endif
                    </th>
                    <th>Tên Sản Phẩm
                        @if(request()->getQueryString() == 'name=desc')
                            <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'name=asc')
                            <a href="{{request()->url()}}?name=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?name=asc"> <i class="fas fa-sort"></i></a>
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
                    <th>Danh Mục</th>
                    <th>Giá Gốc
                        @if(request()->getQueryString() == 'price=desc')
                            <a href="{{request()->url()}}?price=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'price=asc')
                            <a href="{{request()->url()}}?price=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?price=asc"> <i class="fas fa-sort"></i></a>
                        @endif
        
                    </th>
                    <th>Giá sale
                        @if(request()->getQueryString() == 'price_sale=desc')
                            <a href="{{request()->url()}}?price_sale=asc"> <i class="fas fa-sort-up"></i></a>
                        @elseif(request()->getQueryString() == 'price_sale=asc')
                            <a href="{{request()->url()}}?price_sale=desc"> <i class="fas fa-sort-down"></i></a>
                        @else
                            <a href="{{request()->url()}}?price_sale=asc"> <i class="fas fa-sort"></i></a>
                        @endif
                    </th>
                    <th>Active</th>
                    <th>Create
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
                @foreach($products as $key => $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->menu->name }}</td>
                    <td>{{ number_format($product->price,0,'', '.') }}</td>
                    <td>{{ number_format($product->price_sale,0,'', '.') }}</td>
                    <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                    <td>{{ date_format($product->created_at,"d-m-Y") }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                           onclick="removeRow({{ $product->id }}, '/admin/products/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        {{$products->appends(request()->query())->onEachSide(1)->links()}}

    </div>

@endsection




