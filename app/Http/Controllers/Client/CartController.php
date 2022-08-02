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
        if ($result !== false) {
            return response()->json([
                'error' => false,
                'result'   => $result
            ]);
        }

        return response()->json(['error' => true]);

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
        $this->validation($request);
        $this->cartService->addCart($request);

        return redirect()->back();
    }

    public function validation(Request $request)
    {
        return $this->validate($request,[
            'HinhThuc' => 'required',
            'fullname' => 'required|max:255',
            'phonenumber' => 'required|max:255',
            'email' => 'required|email:filter',
            'TP' => 'required|max:255',
            'Quan' => 'required|max:255',
            'address' => 'required|max:255'
        ]);
    }

    public function vnpay(Request $request)
    {
        $this->validation($request);
        $this->cartService->vnpay($request);

        return redirect()->back();
    }
    public function vnpay_return(Request $request)
    {
        if ($request->vnp_ResponseCode != 00) {
            Session::flash('success', 'Đặt Hàng Thất Bại');
            return redirect()->back();
        }else{
            $carts = Session::get('carts');
            Session::flash('success', 'Đặt Hàng Thành Công');
            Session::forget('carts');
            return redirect()->back();
        }
    }
    public function momo(Request $request)
    {
        $this->validation($request);
        $jsonResult = $this->cartService->momo($request);
        return redirect()->to($jsonResult['payUrl']);
    }
    public function momo_return()
    {
        $carts = Session::get('carts');
        Session::flash('success', 'Đặt Hàng Thành Công');
        Session::forget('carts');
        return redirect()->back();
    }

    public function voucher(Request $request)
    {
        if($this->cartService->voucher($request)=== false){
            
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
}
