<?php


namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProductService
{
    public function getNew()
    {
        $limit  = 5;
        return Product::select('id','name','price','price_sale','thumb')
            ->where('active',1)
            ->inRandomOrder()   
            ->limit($limit)
            ->get();
    }
    public function getAll($id)
    {
        return Product::where('menu_id',$id)
        ->limit(5)
        ->get();
    }
    
}