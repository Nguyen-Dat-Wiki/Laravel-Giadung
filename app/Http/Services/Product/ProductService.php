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
        return Product::select('id','quantity','name','price','price_sale','thumb')
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
    
    public function show($id)
    {
        return Product::where('id', $id)
            ->where('active', 1)
            ->with('menu')
            ->firstOrFail();
    }

    public function more($id)
    {
        return Product::where('active', 1)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }
}
    