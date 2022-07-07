<?php


namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use App\Models\Info;
use App\Models\Comment;
use App\Models\Voucher;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;

class ProductService
{
    // get menu name
    public function Menuname()
    {
        return Menu::select('name', 'id')
            ->where('parent_id', 0)
            ->limit(5)
            ->get();
    }
    // get random product limit 5
    public function getNew()
    {
        $limit  = 5;
        return Product::select('id','quantity','name','price','price_sale','thumb')
            ->where('active',1)
            ->inRandomOrder()   
            ->limit($limit)
            ->get();
    }
    // get product theo menu (bao gồm menu con)
    public function getAll($arr_name)
    {
        $arr_menu_id = array(); //arr menu id
        foreach ($arr_name as $key => $value) {
            $arr_menu_id[] = $value->id;
        }
        $arr_return = array();
        foreach ($arr_menu_id as $key => $id) {
            $child_menu= Menu::where('parent_id',$id)->where('active',1)->get(); //Lay danh muc con
            $arr_id = array();
            foreach ($child_menu as $key => $value) {
                $arr_id[] = $value->id;
            }
            array_push($arr_id,$id);
            $arr_return[] = Product::whereIn('menu_id',$arr_id)
            ->where('active',1)
            ->limit(5)
            ->get();
        }
        return $arr_return;
    }
    // get info product
    public function getInfo($id)
    {
        return Info::where('product_id',$id)->firstOrFail();
    }
    // show product
    public function show($id)
    {
        return Product::where('id', $id)
            ->with('menu')
            ->firstOrFail();
    }
    // show product more
    public function more($id)
    {
        return Product::where('active', 1)
            ->where('id', '!=', $id)
            ->inRandomOrder()   
            ->limit(5)
            ->get();
    }
    // add comment
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
    // show comment
    public function showComment ($id)
    {
        return Comment::where('product_id',$id)
        ->orderby('created_at','desc')
        ->paginate(7);
    }
    // click vào detail 1 product bất kỳ sẽ lưu lại đã xem
    public function seen($id)
    {
        $seen = Session::get('seen');
        if (is_null($seen)) {
            Session::put('seen',[
                $id=>1
            ]);
            return true;
        }
        $arr = Arr::add($seen,$id,1);
        Session::put('seen', $arr);
        return true;
    }
    // show product seen ở trang detail 
    public function getProduct()
    {
        $seen = Session::get('seen');
        if (is_null($seen)) return [];
        $productId = array_keys($seen);
        return Product::whereIn('id', $productId)->get();
    }
    // get voucher info
    public function getVoucher()
    {
        return Voucher::where('active',1)->get();
    }
}
    