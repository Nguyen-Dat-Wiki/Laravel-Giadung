<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id='', $slug = '')
    {
        return view('client.products.product', [
            'title' => $this->productService->show($id)->name,
            'product' => $this->productService->show($id),
            'info' => $this->productService->getInfo($id),
            'products' => $this->productService->more($id),
            'comment'=>$this->productService->showComment($id),
            'seen'=> $this->productService->getProduct()
        ]);
    }

    public function comment(Request $request)
    {
        $this->productService->add_comment($request);
        return redirect()->back();
    }
}
