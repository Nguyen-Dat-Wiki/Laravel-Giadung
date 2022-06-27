<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use App\Models\Comment;
use Carbon;


class Helper{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . self::active($menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/menu/edit/' . $menu->id . '">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm"
                                onclick="removeRow(' . $menu->id . ', \'/admin/menu/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '|--');
            }
        }

        return $html;
    }

    public static function active($active = 0): string
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>'
            : '<span class="btn btn-success btn-xs">YES</span>';
    }


    public static function Users($is_admin = 0): string
    {
        return $is_admin == 0 ? '<span class="btn btn-danger btn-xs">User</span>'
            : '<span class="btn btn-success btn-xs">Admin</span>';
    }

    public static function activeCustomer($active = 0): string
    {
        if($active == 1){
            return '<span class="btn btn-danger btn-xs">Đã huỷ</span>';
        }
        else if($active == 2){
            return'<span class="btn btn-primary btn-xs">Chờ xác nhận</span>';
        }
        else if($active == 3){
            return'<span class="btn btn-warning btn-xs">Đang vận chuyển</span>';
        }
        else{
            return '<span class="btn btn-success btn-xs">Đã hoàn thành</span>';
        }
        
    }
    public static function menus($menus, $parent_id = 0) :string
    {   
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li>
                        <a class="text-decoration-none" 
                            href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">
                            <span> ' . $menu->name . '</span>
                           
                        </a>
                        <div class="cat-brand-menu ">';

                unset($menus[$key]);

                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="cat-menu ">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                    $html .= '</div>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }

    public static function isChild($menus, $id) : bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }
        return false;
    }

    public static function fetch_comment($comment,$product_id):string
    {
        $html = '';
        foreach($comment as $row){
            if($row->parent_id == 0){
                Carbon\Carbon::setlocale('vi');
                $time= Carbon\Carbon::create($row['created_at'])->diffForHumans();
                $html .= '
                    <div class="panel panel-default">
                        <div class="panel-heading">By <b>'.$row["name"].'</b> on <i>'. $time .'</i></div>
                        <div class="panel-body">'.$row["content"].'</div>
                        <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id"].'">Trả lời</button></div>
                    </div>
                ';
                $html .= self::get_reply_comment($row["id"],0,$product_id);
            }
        }
        return $html;
    }
    public static function get_reply_comment($parent_id = 0, $marginleft = 0,$product_id){
        $result = Comment::where('parent_id',$parent_id)->get();
        $html = '';
        if($parent_id == 0){
            $marginleft = 0;
        }
        else{
            $marginleft = $marginleft + 48;
        }
        if(count($result) > 0){
            
            foreach($result as $row){
                if($row->product_id == $product_id){
                    Carbon\Carbon::setlocale('vi');
                    $time= Carbon\Carbon::create($row['created_at'])->diffForHumans();
                    $html .= '
                        <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
                            <div class="panel-heading">By <b>'.$row["name"].'</b> on <i>'.$time.'</i></div>
                            <div class="panel-body">'.$row["content"].'</div>
                            <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id"].'">Trả lời</button></div>
                        </div>
                        ';
                    $html .=  self::get_reply_comment($row["id"], $marginleft,$product_id);
                }
            }
        }
        return $html;
    }
    public function SaleVoucher($condition)
    {
        return $condition == 1 ? '<span class="btn btn-primary btn-xs">Giảm theo %</span>'
            : '<span class="btn btn-warning btn-xs">Giảm theo tiền</span>';
    }
    public function CheckTime($time_start,$time_end)
    {
        Carbon\Carbon::setlocale('vi');
        $start= Carbon\Carbon::create($time_start);
        $end= Carbon\Carbon::create($time_end);
        $now = Carbon\Carbon::now();
        if ($now->month > $end->month) {
            return '<span class="btn btn-danger btn-xs">Hết hạn</span>';
        }else if($now->month == $end->month && $now->day > $end->day){
            return '<span class="btn btn-danger btn-xs">Hết hạn</span>';
        }
        else{
            if ($now->day <= $end->day) {
                return '<span class="btn btn-success btn-xs">Còn hạn</span>';
            }
        }
    }
    public function Payment($Payment)
    {
        return $Payment == 2 ? '<span class="btn btn-warning btn-xs">Online</span>'
            : '<span class="btn btn-primary btn-xs">ShipCod</span>';
    }
    public function showCartSetting($customers,$active)
    {
        $html = '';
        foreach($customers as $key => $customer){
            if($customer->active == $active){
                $total=0;
                foreach ($customer->carts as $key => $value) {
                    $price = $value->price * $value->pty;
                    $total += $price;
                }
                if ($customer->voucher != NULL) {
                    if ($customer->vouchers[0]['condition']==1) {
                        $total -= ($total * $customer->vouchers[0]['number'])/100;
                    }
                    elseif ($customer->vouchers[0]['condition']==2) {
                        $total -= $customer->vouchers[0]['number'];
                    }
                }
                $html .='
                    <tr>
                    <td>' .$customer->id. '</td>
                    <td>' .$customer->name.'</td>
                    <td>' .$customer->phone.'</td>
                    <td>'. number_format($total, 0, '', '.'). '</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/setting/cart/'.$customer->id.'">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="/setting/delete/'.$customer->id.'">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                ';
                return $html;
            }
        }
                /*  */
    }
}
