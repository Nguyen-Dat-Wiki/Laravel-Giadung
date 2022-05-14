<?php


namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;

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
            ->limit(5)
            ->get();
    }

    public function comment($request)
    {
        Comment::create([
            'name'=>$request->input('name'),
            'user_id' =>  ($request->input('user_id') == null ) ? null : $request->input('user_id') ,
            'post_id' => 0,
            'product_id'=>$request->input('product_id'),
            'content'=>$request->input('content')
        ]);
        return true;
    }
    public function get($id)
    {
        return DB::table('Comments')->where('product_id',$id)->orderby('created_at', 'desc')->paginate(5);
    }
    public function deleteComment($post_id)
    {
        $id = (int)$post_id;
        $Comment = Comment::where('id', $id)->first();
        if ($Comment) {
            Comment::where('id', $id)->delete();
            return true;
        }
        return false;
    }
    public function add_comment($request)
    {
        Comment::create([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'product_id' => $request->input('product_id'),
            'parent_id'=>$request->input('comment_id'),
        ]);
        return true;
    }
    public function showComment ($id)
    {
        
        return Comment::where('product_id',$id)
        ->paginate(5);
    }
    
}
    