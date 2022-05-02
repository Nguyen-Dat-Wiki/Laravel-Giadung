<?php

namespace App\Http\Services;

use App\Models\User;
use DB;

class UserService{
    public function get()
    {
        return User::select('id','name','email','phone','is_admin','created_at')->orderbyDesc('id')->paginate(15);
    }
    public function getDetail($request)
    {
        return User::select('*')->where('id',$request)->get();
    }
    public function edit($request)
    {
        return DB::table('users')
                ->where('id',$request->input('id'))
                ->update(['is_admin' => $request->input('is_admin')]);
    }
}
