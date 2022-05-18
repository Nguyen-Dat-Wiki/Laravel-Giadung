<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SliderService;
use App\Http\Services\CartService;
use App\Http\Services\Product\ProductAdminService;

use App\Exports\MoneyExport;
use Maatwebsite\Excel\Facades\Excel;

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
            'allproduct'=>$this->product->allproduct(),
            'alluser'=>$this->product->alluser(),
            'customer'=>$this->product->customer(),
            'customer3'=>$this->product->customer3(),
            'customer4'=>$this->product->customer4(),
            'customer1'=>$this->product->customer1(),
            'allcustomer'=>$this->product->allcustomer(),
            'title'=> 'Trang chủ',
            'carts' => $this->product->search_money_all($req),
        ]);
    }
    public function post(Request $req)
    {
        $title = 'Trang chủ';
        return view('admin.dashboard.home',[
            'allproduct'=>$this->product->allproduct(),
            'alluser'=>$this->product->alluser(),
            'customer'=>$this->product->customer(),
            'customer3'=>$this->product->customer3(),
            'customer4'=>$this->product->customer4(),
            'customer1'=>$this->product->customer1(),
            'allcustomer'=>$this->product->allcustomer(),
            'title'=> 'Trang chủ',
            'carts' => $this->product->searchMoney($req),
            'start'=>$req->start,
            'end'=>$req->end,
        ]);
    }
    public function export()
    {
        return Excel::download(new MoneyExport, 'Doanhthu.xlsx');
    }
}
