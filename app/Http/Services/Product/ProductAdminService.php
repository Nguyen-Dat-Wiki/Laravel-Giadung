<?php


namespace App\Http\Services\Product;


use App\Models\Menu;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Info;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\Session;
use DB;


class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }
    // check giá
    protected function isValidPrice($request)
    {
        if ($request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('price_sale') != 0 && (int)$request->input('price') == 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }

        return  true;
    }
    // add product
    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $request->except('_token');
            $product = Product::create([
                'name' => $request->input('name'),
                'quantity' => $request->input('quantity'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'menu_id' => $request->input('menu_id'),
                'price' => $request->input('price'),   
                'price_sale' => $request->input('price_sale'),
                'active' => $request->input('active'),
                'thumb' => $request->input('thumb'),
            ]);
            if($this->insertinfo($request,$product->id)){
                Session::flash('success', 'Thêm Sản phẩm thành công');
            }
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Sản phẩm lỗi');
            \Log::info($err->getMessage());
            return  false;
        }

        return  true;
    }
    // add info product
    protected function insertinfo($request,$product_id)
    {
        Info::insert([
            'wattage' => $request->input('wattage'),
            'control' => $request->input('control'),
            'size' => $request->input('size'),
            'utilities' => $request->input('utilities'),
            'trademark' => $request->input('trademark'),
            'produce' => $request->input('produce'),
            'product_id' => $product_id,
        ]);
        return true;
    }
    // get list product
    public function get($request)
    {
        $query =  Product::with('menu');

        if ($request->input('id')) {
            $query->orderBy('id', $request->input('id'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if ($request->input('quantity')) {
            $query->orderBy('quantity', $request->input('quantity'));
        }
        else if ($request->input('price')) {
            $query->orderBy('price',  $request->input('price'));
        }
        else if($request->input('price_sale')){
            $query->orderBy('price_sale',$request->input('price_sale'));
        } 
        else if($request->input('created_at')){
            $query->orderBy('created_at',$request->input('created_at'));
        } 
        return $query
            ->paginate(15)
            ->withQueryString()
            ->appends(request()->query());
    }
    // get info product
    public function getInfo($product_id)
    {
        return Info::where('product_id',$product_id)->get();
    }
    // update product and info
    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;
        try {
            $product->fill([
                'name' => $request->input('name'),
                'quantity' => $request->input('quantity'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'menu_id' => $request->input('menu_id'),
                'price' => $request->input('price'),
                'price_sale' => $request->input('price_sale'),
                'active' => $request->input('active'),
                'thumb' => $request->input('thumb'),
            ]);
            $product->save();
            DB::table('infos')
                ->where('product_id',$product->id)
                ->update([
                    'wattage' => $request->input('wattage'),
                    'control' => $request->input('control'),
                    'size' => $request->input('size'),
                    'utilities' => $request->input('utilities'),
                    'trademark' => $request->input('trademark'),
                    'produce' => $request->input('produce'),
                ]);
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    // delete product and info
    public function delete($request)
    {
        $info = Info::where('product_id', $request->input('id'))->first();
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            $info->delete();
            $product->delete();
            return true;
        }

        return false;
    }
    public function getSearch($request)
    {   
        $search= $request->input('search');
        return Product::where('name', 'like', '%' . $search . '%')
            ->orderByDesc('id')->paginate(15); 
    }

    // home admin

    public function search_money_all($request)
    {
        $query = Customer::where('active',4)
            ->with('carts')
            ->with('vouchers');
        if ($request->input('id')) {
            $query->orderBy('id', $request->input('id'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if ($request->input('address')) {
            $query->orderBy('address', $request->input('address'));
        }
        else if ($request->input('email')) {
            $query->orderBy('email',  $request->input('email'));
        }
        else if($request->input('created_at')){
            $query->orderBy('created_at',$request->input('created_at'));
        } 
        return $query
            ->paginate(15)
            ->withQueryString()
            ->appends(request()->query());
    }

    public function searchMoney($request)
    {
        $query = Customer::where('active',4)
        ->whereBetween('created_at',[$request->input('start'),$request->input('end')])
        ->with('carts')
        ->with('vouchers');
        
        if ($request->input('id')) {
            $query->orderBy('id', $request->input('id'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if ($request->input('address')) {
            $query->orderBy('address', $request->input('address'));
        }
        else if ($request->input('email')) {
            $query->orderBy('email',  $request->input('email'));
        }
        else if($request->input('created_at')){
            $query->orderBy('created_at',$request->input('created_at'));
        } 
        return $query
            ->paginate(15)
            ->withQueryString()
            ->appends(request()->query());
    }
    
    public function allproduct()
    {
        return DB::table('products')->get();
    }
    public function alluser()
    {
        return User::where('is_admin',0)->get();
    }
    public function customer()
    {
        return Customer::where('active',2)->get();
    }
    public function customer3()
    {
        return Customer::where('active',3)->get();
    }
    public function customer4()
    {
        return Customer::where('active',4)->get();
    }
    public function customer1()
    {
        return Customer::where('active',1)->get();
    }
    public function allcustomer()
    {
        return Customer::whereIn('active',[1,2,3,4])->get();
    }

}
