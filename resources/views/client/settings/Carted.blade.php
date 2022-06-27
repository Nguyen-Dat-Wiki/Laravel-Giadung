@extends('client.index')

@section('head')
    <script src="/asset/js/tab.js"></script>
@endsection

@section('content_new')
    @include('client.layouts.sidebar')
    <div class="carted">
        <div role="tabpanel" class="tab-pane" id="DH">
            <h3>Đơn hàng của tôi</h3>
            <hr>
            <ul class="nav-tabs nav navDH" role="tablist">
                <li role="presentation"class="active"><a href="#Reply" class="text-dark" role="tab" data-toggle="tab">Chờ xác nhận</a></li>
                <li role="presentation"><a href="#GH" class="text-dark" a role="tab" data-toggle="tab">Đang giao</a></li>
                <li role="presentation"><a href="#DaGiao" class="text-dark" role="tab" data-toggle="tab">Đã giao</a></li>
                <li role="presentation"><a href="#Ca" class="text-dark" role="tab" data-toggle="tab">Đã hủy</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active " id="Reply">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">#</th>
                                    <th class="column-2 align-middle">Tên</th>
                                    <th class="column-2"style="white-space:nowrap">Số điện thoại</th>
                                    <th class="column-4"style="white-space:nowrap">Tổng tiền</th>
                                    <th class="column-6">&nbsp;</th>
                                </tr>
                                {!! \App\Helpers\Helper::showCartSetting($customers,2) !!}
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div role="tabpanel" class="tab-pane " id="GH">
                    <div class="table-responsive-sm table-responsive-lg">
                        <table class="table">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">#</th>
                                    <th class="column-2 align-middle">Tên</th>
                                    <th class="column-2"style="white-space:nowrap">Số điện thoại</th>
                                    <th class="column-4"style="white-space:nowrap">Tổng tiền</th>
                                    <th class="column-6">&nbsp;</th>
                                </tr>
                                {!! \App\Helpers\Helper::showCartSetting($customers,3) !!}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane " id="DaGiao">
                    <div class="table-responsive-sm table-responsive-lg">
                        <table class="table">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">#</th>
                                    <th class="column-2 align-middle">Tên</th>
                                    <th class="column-2"style="white-space:nowrap">Số điện thoại</th>
                                    <th class="column-4"style="white-space:nowrap">Tổng tiền</th>
                                    <th class="column-6">&nbsp;</th>
                                </tr>
                                {!! \App\Helpers\Helper::showCartSetting($customers,4) !!}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane " id="Ca">
                    <div class="table-responsive-sm table-responsive-lg">
                        <table class="table">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">#</th>
                                    <th class="column-2 align-middle">Tên</th>
                                    <th class="column-2"style="white-space:nowrap">Số điện thoại</th>
                                    <th class="column-4"style="white-space:nowrap">Tổng tiền</th>
                                    <th class="column-6">&nbsp;</th>
                                </tr>
                                {!! \App\Helpers\Helper::showCartSetting($customers,1) !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection