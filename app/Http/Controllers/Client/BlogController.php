<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\SliderService;
use App\Http\Services\NewsService;


class BlogController extends Controller
{

    protected $Slider;
    protected $product;
    protected $news;

    public function __construct(SliderService $Slider, NewsService $news)
    {
        $this->Slider = $Slider;
        $this->news = $news;
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

    public function search(Request $request)
    {
        return view('client.blogs.news',[
            'title'=>'Tin tức',
            'title2'=>'Tìm kiếm',
            'news' => $this->news->getsearch($request),
            'news_time'=> $this->news->getTime(),
            'slider'=>$this->Slider->show(),
        ]);
    }
}