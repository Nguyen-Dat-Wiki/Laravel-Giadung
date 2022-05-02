<?php


namespace App\Http\Services;


use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Support\Arr;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use DB;
use Mail;


class CartService
{
    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        $sl = Product::select('quantity')->where('id',$product_id)->get();

        if($qty> $sl[0]['quantity']){
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }
        else if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }
        else{
            $carts = Session::get('carts');
            if (is_null($carts)) {
                Session::put('carts', [
                    $product_id => $qty
                ]);
                return true;
            }
    
            $exists = Arr::exists($carts, $product_id);
            if ($exists) {
                
                $carts[$product_id] = $carts[$product_id] + $qty;
                Session::put('carts', $carts);
                return true;
            }
    
            $carts[$product_id] = $qty;
            Session::put('carts', $carts);
    
            return true;
        }

    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $productId = array_keys($carts);
        return Product::select('id','quantity', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request)
    {   
        
        Session::put('carts', $request->input('num_product'));

        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }

    public function addCart($request)
    {   
        
        try {
            DB::beginTransaction();

            $carts = Session::get('carts');

            if (is_null($carts))
                return false;
            
            $customer = Customer::create([
                'name' => $request->input('fullname'),
                'phone' => $request->input('phonenumber'),
                'address' => $request->input('address').' ' .$request->input('Phường').' ' .$request->input('Quan').' ' .$request->input('TP'),
                'email' => $request->input('email'),
                'content' => $request->input('note'),
                'active' => 1,
            ]);
            if($this->infoProductCart($carts, $customer->id)){
                
                $id =$customer->id;
                $time= $customer->created_at;
                
                DB::commit();
                Session::flash('success', 'Đặt Hàng Thành Công');

                Session::forget('carts');
            }
           

        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        // send Mail
        Mail::send('Client.Mail.ShipMail', [
            'name'=>$request->input('fullname'),
            'email' =>$request->input('email'),
            'phone' =>$request->input('phonenumber'),
            'address' =>$request->input('address').' ' .$request->input('Phường').' ' .$request->input('Quan').' ' .$request->input('TP'),
            'total' => $request->input('total'),
            'id'=> $id,
            'time'=> $time
        ], function ($message) use($request) {
            $message->to($request->input('email'),  $request->input('fullname'));
            $message->from('datanhem456@gmail.com');
            $message->subject('Email hoá đơn điện tử');
        });



        return true;
    }

    protected function infoProductCart($carts, $customer_id)
    {
        $productId = array_keys($carts);
        $products = Product::select('id','quantity', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $data = [];
        foreach ($products as $product) {
            if($carts[$product->id] <= $product->quantity ){
                $data[] = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'pty'   => $carts[$product->id],
                    'price' => $product->price_sale 
                ];


                $tonkho = $product->quantity - $carts[$product->id];


                DB::table('products')
                ->where('id',$product->id)
                ->update(['quantity' => $tonkho]);
            }
            else{
                return false;
            }
        }
        return Cart::insert($data);
    }



    //admin
    public function getCustomer()
    {
        return Customer::orderByDesc('id')->paginate(15);
    }

    public function getProductForCart($customer)
    {
        return $customer->carts()->with(['product' => function ($query) {
            $query->select('id', 'name', 'thumb');
        }])->get();
    }

    public function delete($request)
    {   
        $id = (int)$request->input('id');
        $menu = Customer::where('id', $id)->first();
        if ($menu) {
            Customer::where('id', $id)->delete();
            Cart::where('customer_id', $id)->delete();
            return true;
        }

        return false;
    }
    
    public function updateActive($request)
    {   
        return DB::table('customers')
                ->where('id',$request->input('customer_id'))
                ->update(['active' => $request->input('actives')]);
    }
}
