<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'active',
        'address',
        'user_id',
        'email',
        'payment',
        'content',
        'voucher',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }
    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'id', 'voucher');
    }
    public function exportExcel()
    {
        $arr= array();
        $carts=Customer::whereIn('active',[3,4])
            ->with('carts')
            ->get();
        foreach($carts as $key => $customer){
            $total=0;
            $price = $customer->carts[0]['price'] * $customer->carts[0]['pty'];
            $total += $price;
            if ($customer->voucher != NULL) {
                if ($customer->vouchers[0]['condition']==1) {
                    $total_sale = ($total * $customer->vouchers[0]['number'])/100;
                    $total -= $total_sale;
                }
                elseif ($customer->vouchers[0]['condition']==2) {
                    $total -= $customer->vouchers[0]['number'];
                }
            }
            $data[] =[
                'STT'=> $customer->id,
                'Ten'=>$customer->name,
                'DiaChi'=>$customer->address,
                'Email'=>$customer->email,
                'Phone'=>number_format($customer->phone,0,',',' '),
                'Ngày'=>date_format($customer->created_at,'d-m-y'),
                'Tổng tiền'=> $total
            ];
        }
        array_push($arr,$data);
        return $arr;
    }
}

