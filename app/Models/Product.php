<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'thumb'
    ];

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')
            ->withDefault(['name' => '']);
    }
    public function exportExcel()
    {
        $arr = array();
        $products = Product::with('menu')->get();
        foreach ($products as $key => $value) {
            $data[]=[
                'STT'=>$value->id,
                'Name'=>$value->name,
                'Quantity'=>$value->quantity,
                'Name_menu'=>$value->menu->name,
                'Price'=>$value->price,
                'Price_sale'=>$value->price_sale,
                'actice'=>($value->active==1) ? 'Được kích hoạt' : 'Không kích hoạt',
                'update_at'=>date_format($value->updated_at,'d-m-y')
            ];
        }
        array_push($arr,$data);
        return $arr;
    }
}
