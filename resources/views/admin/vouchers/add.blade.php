@extends('admin.index')

@section('content')
<form action="" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Tên voucher</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Mã voucher</label>
                    <input type="text" name="code" value="{{ old('code') }}" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="menu">Số lượng</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}"  class="form-control" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Điều kiện</label>
                    <select class="form-control" name="condition">
                        <option value="1">Giảm theo %</option>
                        <option value="2">Giảm theo tiền</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Điều kiện</label>
                    <select class="form-control" name="Payment">
                        <option value="1">Thanh toán bằng tiền mặt</option>
                        <option value="2">Thanh toán bằng chuyển khoản</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="menu">Tiền giảm</label>
                    <input type="number" name="number" value="{{ old('nummber') }}"  class="form-control" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="menu">Ngày bắt đầu</label>
                    <input type="datetime-local" name="time_start" value="{{ old('time_start') }}"  class="form-control" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="menu">Ngày kết thúc</label>
                    <input type="datetime-local" name="time_end" value="{{ old('time_end') }}"  class="form-control" >
                </div>
            </div>
           
        </div>


        <div class="form-group">
            <label>Kích Hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm voucher</button>
    </div>
    @csrf
</form>
@endsection