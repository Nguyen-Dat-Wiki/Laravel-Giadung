<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Session;
use DB;

class SettingController extends Controller
{
    protected $user;
    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('client.settings.info',[
            'title'=>'Cài đặt thông tin'
        ]);
    }
    public function edit(Request $request)
    {
        $this->user->update($request);
        return redirect()->back();
    }
    public function show($id)
    {
        $customer = $this->user->getCustomer($id);
        return view('client.settings.Carted',[
            'title'=>'Danh sách đơn hàng',
            'customers'=>$customer,
        ]);
    }
    public function showcart($id)
    {
        $customer= Customer::where('id',$id)->first();
        $carts = $this->user->getProductForCart($customer);
        return view('client.settings.cartinfo', [
            'title' => 'Chi Tiết Đơn Hàng: ' . $customer->name,
            'customer' => $customer,
            'carts' => $carts,
        ]);
    }

    public function pass()
    {
        return view('client.settings.pass',[
            'title'=>'Danh sách đơn hàng',
        ]);
    }
    public function update(Request $request)
    {
        $this->validation($request);
        $result = $this->user->pass($request);
        if ($result) {
            return redirect('/'); 
        }
        return redirect()->back();


    }

    public function create_pass(Request $request)
    {
        $result = $this->user->passnew($request);
        if ($result) {
            return redirect('/'); 
        }
        return redirect()->back();
    }
    public function validation(Request $request)
    {
        return $this->validate($request,[
            'new_pass' => 'required|min:6|max:100',
            'confirm_pass' => 'required|same:new_pass',
        ]);
    }
    public function delete(Request $request)
    {
        $result= $this->user->delete($request);
        if($result){
            return redirect()->back();
        }
    }
}
