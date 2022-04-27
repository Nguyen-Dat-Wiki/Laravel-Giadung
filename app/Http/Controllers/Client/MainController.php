<?php

namespace App\Http\Controllers\Client;

use App\Http\Services\Product\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Services\SliderService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $Slider;
    protected $product;

    public function __construct(SliderService $Slider, ProductService $product)
    {
        $this->Slider = $Slider;
        $this->product = $product;
    }
    public function index()
    {
        $title = 'Trang chủ';
        $slider = $this->Slider->show();
        $products = $this->product->getnew();
        $category_1 = $this->product->getAll(6);
        $category_2 = $this->product->getAll(7);
        $category_3 = $this->product->getAll(8);
        $category_4 = $this->product->getAll(9);
        $category_5 = $this->product->getAll(10);
        return view('client.home',
            compact('title',
            'slider',
            'products',
            'category_1',
            'category_2',
            'category_3',
            'category_4',
            'category_5'));
    }
}
