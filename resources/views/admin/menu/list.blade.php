@extends('admin.index')

@section('content')
    
    <div class="table-responsive table-responsive-lg">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 50px">ID</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th style="width: 100px">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {!! \App\Helpers\Helper::menu($menus) !!}
            </tbody>
        </table>
        {{$menus->appends(request()->query())->onEachSide(1)->links()}}


    </div>
@endsection


