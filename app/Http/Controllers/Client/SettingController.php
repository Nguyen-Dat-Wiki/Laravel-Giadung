<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Session;


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
    public function show(Customer $customer, $id)
    {
        $customer = $this->user->getCustomer($id);
        $arr =$this->user->getProductForCart($customer);
        return view('client.settings.Carted',[
            'title'=>'Danh sách đơn hàng',
            'actives'=>$customer,
            'carts'=>$arr,
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
    public function validation(Request $request)
    {
        return $this->validate($request,[
            'old_pass' => 'required',
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
