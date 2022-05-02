<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    protected $User;

    public function __construct(UserService $User)
    {
        $this->User = $User;
    }
    public function index()
    {
        return view('admin.users.list', [
            'title' => 'Danh sách người dùng',
            'users' => $this->User->get()
        ]);
    }
    public function show($id)
    {   
        $users  = $this->User->getDetail($id);
        return view('admin.users.detail',[
            'title'=>'Chi tiết người dùng',
            'user' => $users
        ]);
    }
    public function active(Request $request)
    {
        $result = $this->User->edit($request);
        if ($result) {
            return redirect('admin/user');
        }
        return redirect()->back();
    }
}
