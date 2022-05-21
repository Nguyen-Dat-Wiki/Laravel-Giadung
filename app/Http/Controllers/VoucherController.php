<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\VoucherService;
use App\Models\Voucher;


class VoucherController extends Controller
{
    
    protected $voucher;

    public function __construct(VoucherService $voucher)
    {
        $this->voucher = $voucher;
    }

    public function index()
    {
        return view('admin.vouchers.add', [
            'title' => 'Thêm voucher'
        ]);
    }
    public function add(Request $request)
    {
        $this->voucher->add($request);
        return redirect()->back();
    }
    public function show(Request $request)
    {
        return view('admin.vouchers.list', [
            'title' => 'Danh sách voucher',
            'Vouchers' => $this->voucher->get($request),
        ]); 
    }
    public function store(Voucher $voucher)
    {
        return view('admin.vouchers.edit', [
            'title'=> 'Chỉnh sửa voucher',
            'Vouchers'=> $voucher,
        ]);
    }
    public function update(Request $request, Voucher $voucher)
    {
        $result = $this->voucher->update($request, $voucher);
        if ($result) {
            return redirect('/admin/vouchers/list');
        }
        return redirect()->back();
    }
}
