<?php

namespace App\Http\Services;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use DB;

class VoucherService{

    protected function isValidPrice($request)
    {
        Carbon::setlocale('vi');
        $start= Carbon::create($request->time_start);
        $end= Carbon::create($request->time_end);

        if ($end->month > $start->month) {
            return true;
        }else if($end->month == $start->month && $end->day > $start->day){
            return true;
        }
        else{
            Session::flash('error', 'Vui lòng nhập ngày kết thúc lớn hơn');
            return false;
        }
    }

    public function add($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;
        try {
            $request->except('_token');
            Voucher::create($request->input());
            Session::flash('success', 'Thêm Voucher thành công');

        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Voucher lỗi');
            \Log::info($err->getMessage());
            return  false;
        }
        return  true;
    }
    public function get($request)
    {
        $query = DB::table('vouchers');
        if ($request->input('id')) {
            $query->orderBy('id', $request->input('id'));
        }
        else if ($request->input('name')) {
            $query->orderBy('name', $request->input('name'));
        }
        else if ($request->input('code')) {
            $query->orderBy('code', $request->input('code'));
        }
        else if ($request->input('quantity')) {
            $query->orderBy('quantity',  $request->input('quantity'));
        }
        else if ($request->input('Payment')) {
            $query->orderBy('Payment',  $request->input('Payment'));
        }
        else if ($request->input('condition')) {
            $query->orderBy('condition',  $request->input('condition'));
        }
        else if ($request->input('time_start')) {
            $query->orderBy('time_start',  $request->input('time_start'));
        }
        else if ($request->input('time_end')) {
            $query->orderBy('time_end',  $request->input('time_end'));
        }
        return $query
            ->paginate(15)
            ->withQueryString()
            ->appends(request()->query());
    }

    public function update($request,$voucher)
    {
        
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;
        try {
            $voucher->fill($request->input());
            $voucher->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}