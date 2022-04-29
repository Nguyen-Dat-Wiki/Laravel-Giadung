<?php

namespace App\Http\Controllers\Client\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Đăng nhập';   
        return view('client.login',compact('title'));
    }
}
