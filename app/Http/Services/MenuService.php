<?php


namespace App\Http\Services;


use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use DB;

class MenuService
{
    // lấy menu lớn
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    // show menu lớn
    public function show()
    {
        return Menu::select('name', 'id')
            ->where('parent_id', 0)
            ->orderbyDesc('id')
            ->get();
    }
    // get tất cả menu lớn
    public function getAllParent()
    {
        return Menu::where('parent_id', 0)
            ->orderbyDesc('id')
            ->paginate(25);
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(30);
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string)$request->input('name'),
                'parent_id' => (int)$request->input('parent_id'),
                'active' => (string)$request->input('active')
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }

    public function update($request, $menu): bool
    {
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->name = (string)$request->input('name');
        $menu->active = (string)$request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }
    //client
    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }
    // lấy tất cả sản phẩm thuộc danh mục (cả lớn và nhỏ)
    public function getProduct($id, $request)
    {
        $child_menu= Menu::where('parent_id',$id)->where('active',1)->get(); //Lay danh muc con
        $arr = array();
        foreach ($child_menu as $key => $value) {
            $arr[] = $value->id;
        }
        array_push($arr,$id); //mảng chứa ID cha hoặc ID con hoặc cả 2

        $query = Product::whereIn('menu_id',$arr);   //whereIn dùng để lấy id trong mảng

        if ($request->input('price')) {
            $query->orderBy('price_sale', $request->input('price'));
        }
        else if ($request->input('create_at')) {
            $query->orderBy('price_sale', $request->input('create_at'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if($request->input('tinhtrang')){
            $query->where('active',$request->input('tinhtrang'));
        }
        else if ($request->input('start')) {
            $query->where('price_sale', '>', $start)
                ->where('price_sale', '<', $end);
        }
        else if($request->input('LocSP')){
            $query->orderBy('name',$request->input('LocSP'));
        } 

        return $query
            ->paginate(10)
            ->withQueryString()
            ->appends(request()->query());
    } 
    // lấy tất cả sản phẩm được kích hoạt (được bán)
    public function getProductAll($request)
    {   
        if($request->input('tinhtrang') == '0'){
            $query = DB::table('products')->where('active',0);
        }else{
            $query = DB::table('products')->where('active',1);
        }
        
        if ($request->input('price')) {
            $query->orderBy('price_sale', $request->input('price'));
        }
        else if ($request->input('create_at')) {
            $query->orderBy('create_at', $request->input('create_at'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if ($request->input('start') !=null) {
            $query->where('price_sale', '>', $request->input('start'))
                ->where('price_sale', '<', $request->input('end'));
        }
        else if($request->input('LocSP')){
            $query->orderBy('name',$request->input('LocSP'));
        } 

        return $query
            ->paginate(10)
            ->withQueryString()
            ->appends(request()->query());
    }

    public function getSearch($request)
    {
        return Product::where('name', 'LIKE', "%{$request->input('search')}%")
        ->paginate(10);
    }
}
