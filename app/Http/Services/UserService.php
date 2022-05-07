<?php

namespace App\Http\Services;

use DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserService{
    public function get($request)
    {
        $query =  DB::table('users');

        if ($request->input('id')) {
            $query->orderBy('id', $request->input('id'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if ($request->input('phone')) {
            $query->orderBy('phone', $request->input('phone'));
        }
        else if ($request->input('email')) {
            $query->orderBy('email',  $request->input('email'));
        }
        else if($request->input('is_admin')){
            $query->orderBy('is_admin',$request->input('is_admin'));
        } 
        else if($request->input('created_at')){
            $query->orderBy('created_at',$request->input('created_at'));
        } 
        return $query
            ->paginate(15)
            ->withQueryString()
            ->appends(request()->query());
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

    // client
    public function update($request)
    {
        User::where('id',$request->input('id'))
        ->update(array(
            'name'=>$request->input('name'),
            'address'=>$request->input('address'),
            'phone'=>$request->input('phone'),
        ));
        Session::flash('success', 'Đã cập nhật thông tin');
        return true;
    }


    public function getCustomer($id)
    {
        return Customer::where('user_id',$id)->get();
    }
    public function getProductForCart($customer)
    {   
        $data = array();
        foreach ($customer as $key => $value) {
            $cart = Cart::with('product')->where('customer_id',$value->id)->get();
            foreach ($cart as $key => $item) {
                $data[]= [
                    'name'=>$item->product->name,
                    'thumb'=>$item->product->thumb,
                    'quantity'=>$item->pty,
                    'price'=>$item->price,
                    'active'=>$value->active,
                    'time'=>$value->created_at,
                ];
            }
        }
        return $data;
    }

    public function pass($request)
    {
        
        $current_user = Auth::user();

        if(Hash::check($request->old_pass, $current_user->password)){
            $user = User::find(Auth::id()); 
            $user->password = Hash::make($request->new_pass);
            $user->save();
            Auth::logout();
            Session::flash('success','Đã đổi mật khẩu');
            return true;
        }
        else{
            Session::flash('error','Mật khẩu cũ sai');
            return false;
        }
    }
}
