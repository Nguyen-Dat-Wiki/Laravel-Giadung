@extends('client.index')

@section('content_new')
    @include('client.layouts.sidebar')
    
        <div class="profile border">
            @if (session('success'))
            <script >
                alert('{{ session('success') }}');
            </script>
            @endif
                    
            <h3>Thông tin cá nhân</h3>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Họ tên</label>
                            <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control"  placeholder="Họ tên" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="menu">Số điện thoại</label>
                            <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control"  placeholder="Số điện thoại" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" class="form-control"  value="{{Auth::user()->email}}" disabled="" placeholder="Địa chỉ">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input name="address" class="form-control"  value="{{Auth::user()->address}}"  placeholder="Địa chỉ">
                </div>
                <button type="submit" class="px-5 py-2 btn btn-primary">Cập nhật</button>
                <input type="text" name="id" hidden value="{{Auth::user()->id}}">
                @csrf
            </form>
        </div>  
    </div>

@endsection