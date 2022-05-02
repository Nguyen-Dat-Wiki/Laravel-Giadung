<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SliderService;
use App\Http\Services\Product\ProductService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SliderService $Slider, ProductService $product)
    {
        $this->Slider = $Slider;
        $this->product = $product;
        $this->middleware('auth');
    }
    protected $Slider;
    protected $product;

    public function adminHome()
    {
        $title = 'Trang chủ';
        return view('admin.dashboard.home',compact('title'));
    }
}
