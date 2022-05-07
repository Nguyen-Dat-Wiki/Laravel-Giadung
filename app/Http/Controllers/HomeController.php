<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SliderService;
use App\Http\Services\CartService;
use App\Http\Services\Product\ProductAdminService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $cart;
    protected $product;
    public function __construct(CartService $cart, ProductAdminService $product)
    {
        $this->cart = $cart;
        $this->product = $product;
        $this->middleware('auth');
    }

    public function adminHome(Request $req)
    {
        $title = 'Trang chủ';
        
        $title = 'Trang chủ';
        return view('admin.dashboard.home',[
            'title'=> 'Trang chủ',
            'carts' => $this->product->search_money_all($req),
        ]);
    }
    public function post(Request $req)
    {
        $title = 'Trang chủ';
        return view('admin.dashboard.home',[
            'title'=> 'Trang chủ',
            'carts' => $this->product->searchMoney($req),
            'start'=>$req->start,
            'end'=>$req->end,
        ]);
    }
}
