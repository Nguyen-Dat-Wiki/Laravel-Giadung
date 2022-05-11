<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productsMore = $this->productService->more($id);
        $comment = $this->productService->get($id);
        return view('client.product', [
            'title' => $product->name,
            'product' => $product,
            'products' => $productsMore,
            'comment'=> $comment
        ]);
    }
    public function comment(Request $request)
    {
        $this->productService->comment($request);
        return redirect()->back();
    }
    public function delete($id = '', $slug = '', $post_id= 0)
    {
        $resu = $this->productService->deleteComment($post_id);
        if($resu){
            return redirect()->back();
        }
    }
}
