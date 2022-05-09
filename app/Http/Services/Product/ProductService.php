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
        $child_menu= Menu::where('parent_id',$id)->where('active',1)->get(); //Lay danh muc con
        $arr = array();
        foreach ($child_menu as $key => $value) {
            $arr[] = $value->id;
        }
        array_push($arr,$id);
        return Product::whereIn('menu_id',$arr)
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
    