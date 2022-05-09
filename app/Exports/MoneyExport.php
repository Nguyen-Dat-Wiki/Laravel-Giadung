<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MoneyExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array
    {
        return[
            'STT',
            'Ten',
            'DiaChi',
            'Email',
            'Phone',
            'Ngày đặt',
            'Tổng tiền'
        ];
    }

    public function collection()
    {
        return collect(Customer::exportExcel());
    }
}
