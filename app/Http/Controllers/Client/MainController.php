<?php

namespace App\Http\Controllers\Client;

use App\Http\Services\Product\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Services\SliderService;
use App\Http\Services\NewsService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $Slider;
    protected $product;
    protected $news;

    public function __construct(SliderService $Slider, ProductService $product, NewsService $news)
    {
        $this->Slider = $Slider;
        $this->product = $product;
        $this->news = $news;
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
    public function intro()
    {
        return view('client.Info.intro',[
            'title' =>'Giới thiệu'
        ]);
    }
    public function pay()
    {
        return view('client.Info.pay',[
            'title' =>'Thanh toán'
        ]);
    }
    public function insur()
    {
        return view('client.Info.insurance',[
            'title' =>'Bảo hành'
        ]);
    }
    public function contact()
    {
        return view('client.Info.contact',[
            'title' =>'Liên hệ'
        ]);
    }
    public function news()
    {
        return view('client.blogs.news',[
            'title' =>'Tin tức',
            'slider'=>$this->Slider->show(),
            'news' =>$this->news->get(),
            'news_time'=>$this->news->getTime()
        ]);
    }
    public function detail_news($id = '', $slug = '')
    {
        $news = $this->news->show($id);

        return view('client.blogs.detail', [
            'title' => $news->title,
            'new' => $news,
            'news_time'=>$this->news->getTime(),
            'slider'=>$this->Slider->show(),
        ]);
    }
}
