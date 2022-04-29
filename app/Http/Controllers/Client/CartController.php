<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Session;



class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        
        $result = $this->cartService->create($request); 
        if ($result === false) {
            return redirect()->back();
        }

        return redirect('/gio-hang'); 
    }

    public function show()
    {
        $products = $this->cartService->getProduct();

        return view('client.cart', [
            'total'=> 0,
            'title' => 'Giỏ Hàng',
            'products' => $products,
            'carts' => Session::get('carts')
        ]);
    }

    public function update(Request $request)
    {   
        $this->cartService->update($request);

        return redirect('/gio-hang');
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);

        return redirect('/gio-hang');
    }

    public function addCart(Request $request)
    {
        dd($request->all());
        $this->cartService->addCart($request);

        return redirect()->back();
    }
}
