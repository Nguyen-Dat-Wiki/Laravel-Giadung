<?php


namespace App\Http\Services;


use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Support\Arr;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use DB;
use Mail;
use Carbon\Carbon;

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

    public function addCart($request,$codeID=null)
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
                'content' => ($request->input('note')==null) ? null : $request->input('note'),
                'user_id'=> ($request->input('user_id')==null) ? null : $request->input('user_id'),
                'payment'=>$request->input('HinhThuc')
            ]);
            if($this->infoProductCart($carts, $customer->id)){
                
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
        if($codeID == null){
            $codeID = rand(00,9999);
        }
        Mail::send('Client.Mail.ShipMail', [
            'name'=>$request->input('fullname'),
            'email' =>$request->input('email'),
            'phone' =>$request->input('phonenumber'),
            'address' =>$request->input('address').' ' .$request->input('Phường').' ' .$request->input('Quan').' ' .$request->input('TP'),
            'total' => $request->input('total'),
            'id'=> $codeID,
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
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $data = [];
        foreach ($products as $product) {
            // check ton kho
            if($carts[$product->id] <= $product->quantity ){
                $data[] = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'pty'   => $carts[$product->id],
                    'price' => $product->price_sale,
                    'created_at' => $time
                ];

                DB::table('products')
                ->where('id',$product->id)
                ->update(['quantity' => $product->quantity - $carts[$product->id]]);
            }
            else{
                return false;
            }
        }
        return Cart::insert($data);
    }

    public function vnpay($request)
    {
        $codeID = rand(00,9999);
        $this->addcart($request,$codeID);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/vnpay_php/return";
        $vnp_TmnCode = "K66APULO";//Mã website tại VNPAY 
        $vnp_HashSecret = "NBATWOLMBKUXJPBMDOEWOLRNWKHYUUQR"; //Chuỗi bí mật

        $vnp_TxnRef = $codeID; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'BillPayment';
        $vnp_Amount = $request->total * 100;  //giá trị tiền
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        
    }



    //admin
    public function getCustomer($request)
    {
        $query =  DB::table('customers');

        if ($request->input('id')) {
            $query->orderBy('id', $request->input('id'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if ($request->input('phone')) {
            $query->orderBy('phone', $request->input('phone'));
        }
        else if ($request->input('email')) {
            $query->orderBy('email',  $request->input('email'));
        }
        else if($request->input('active')){
            $query->orderBy('active',$request->input('active'));
        } 
        else if($request->input('created_at')){
            $query->orderBy('created_at',$request->input('created_at'));
        } 
        return $query
            ->paginate(15)
            ->withQueryString()
            ->appends(request()->query());
    }
    // get detail customer-cart
    public function getProductForCart($customer)
    {
        return $customer->carts()->with(['product' => function ($query) {
            $query->select('id', 'name', 'thumb');
        }])->get();
    }
    // delete customer
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
        if($request->input('actives')== 0){

            $carts = Cart::where('customer_id', $request->input('customer_id'))->get();

            foreach ($carts as $key => $value) {
                $qty = Product::select('quantity')->where('id',$value->product_id)->get();
                //update quantity product
                DB::table('products')
                ->where('id',$value->product_id)
                ->update(['quantity' => ($value->pty + $qty[0]['quantity'] )   ]    );
            }
        }
        // update active customer
        return DB::table('customers')
                ->where('id',$request->input('customer_id'))
                ->update(['active' => $request->input('actives')]);
    }

    public function getCustomerActive($request)
    {
        $query =  Customer::where('active',2);

        if ($request->input('id')) {
            $query->orderBy('id', $request->input('id'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if ($request->input('phone')) {
            $query->orderBy('phone', $request->input('phone'));
        }
        else if ($request->input('email')) {
            $query->orderBy('email',  $request->input('email'));
        }
        else if($request->input('active')){
            $query->orderBy('active',$request->input('active'));
        } 
        else if($request->input('created_at')){
            $query->orderBy('created_at',$request->input('created_at'));
        } 
        return $query
            ->paginate(15)
            ->withQueryString()
            ->appends(request()->query());
    }
}
