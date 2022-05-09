<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Customer;

class ProductExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array
    {
        return[
            'STT',
            'Tên sản phẩm',
            'Số lượng',
            'Danh mục',
            'Giá gốc',
            'Giá giảm',
            'Trạng thái',
            'Thời gian'
        ];
    }

    public function collection()
    {
        return collect(Product::exportExcel());
    }
}
