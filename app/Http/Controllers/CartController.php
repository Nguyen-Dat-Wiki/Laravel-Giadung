<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Active;
use App\Http\Services\CartService;
use Illuminate\Http\JsonResponse;
use DB;
use PDF;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index(Request $request)
    {
        return view('admin.carts.customer', [
            'title' => 'Danh Sách Đơn Đặt Hàng',
            'customers' => $this->cart->getCustomer($request)
        ]);
    }

    public function show(Customer $customer)
    {
        $carts = $this->cart->getProductForCart($customer);
        $actives = DB::select('select * from actives ');
        return view('admin.carts.detail', [
            'title' => 'Chi Tiết Đơn Hàng: ' . $customer->name,
            'customer' => $customer,
            'carts' => $carts,
            'actives' =>$actives
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->cart->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function active(Request $request)
    {
        $result = $this->cart->updateActive($request);
        if ($result) {
            return redirect('admin/customers');
        }
        return redirect()->back();
    }
    public function print(Customer $customer)
    {
        $carts = $this->cart->getProductForCart($customer);
        $actives = DB::select('select * from actives ');

        $data = [
            'heading' => 'Hoá đơn của '.$customer->name,
            'customer' => $customer,
            'carts' => $carts,
        ];
        $pdf = PDF::loadView('admin.PDF.yourpdf', $data);
        return $pdf->download('Hoadon.pdf'); 

        /* return view('admin.PDF.yourpdf', [
            'heading' => 'Chi Tiết Đơn Hàng: ' . $customer->name,
            'customer' => $customer,
            'carts' => $carts,
            'actives' =>$actives
        ]); */
    }
}