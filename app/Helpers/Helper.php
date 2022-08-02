<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use App\Models\Comment;
use App\Models\Info;
use App\Models\Product;
use Carbon;
use DB;


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
 /*    public static function comment($comments, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($comments as $key => $comment) {
            if ($comment->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $comment->id . '</td>
                        <td>' . $char . $comment->product->name . '</td>
                        <td>' . $comment->name . '</td>
                        <td>' . $comment->content . '</td>
                        <td>' . $comment->updated_at . '</td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm"
                                onclick="removeRow(' . $comment->id . ', \'/admin/comment/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($comments[$key]);

                $html .= self::comment($comments, $comment->id, $char . '|--');
            }
        }

        return $html;
    } */

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
    public static function SaleVoucher($condition)
    {
        return $condition == 1 ? '<span class="btn btn-primary btn-xs">Giảm theo %</span>'
            : '<span class="btn btn-warning btn-xs">Giảm theo tiền</span>';
    }
    public static function CheckTime($time_start,$time_end,$id,$active)
    {
        Carbon\Carbon::setlocale('vi');
        $start= Carbon\Carbon::create($time_start);
        $end= Carbon\Carbon::create($time_end);
        $now = Carbon\Carbon::now();
        if ($active == 0) {
            return '<span class="btn btn-danger btn-xs">Hết hạn</span>';
        }else{
            // auto cập nhật date
            if ($now->month > $end->month) {
                DB::table('vouchers')->where('id',$id)->update(['active' => 0]);
                return '<span class="btn btn-danger btn-xs">Hết hạn</span>';
            }else if($now->month == $end->month && $now->day > $end->day){
                DB::table('vouchers')->where('id',$id)->update(['active' => 0]);
                return '<span class="btn btn-danger btn-xs">Hết hạn</span>';
            }
            return '<span class="btn btn-success btn-xs">Còn hạn</span>';
        }
    }
    public static function Payment($Payment)
    {
        return $Payment == 2 ? '<span class="btn btn-warning btn-xs">Online</span>'
            : '<span class="btn btn-primary btn-xs">ShipCod</span>';
    }
    public static function showCartSetting($customers,$active)
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
                    ';
                if ($active == 2) {
                    $html .='
                        <a class="btn btn-danger btn-sm" href="/setting/delete/'.$customer->id.'">
                                <i class="fas fa-trash"></i>
                        </a>
                        </td>
                    </tr
                    ';
                }
            }
        }
        return $html;
        /* > */
    }
    public static function tooltip($id)
    {
        $results = Info::where('product_id',$id)->firstOrFail();
        $product = Product::where('id', $id)
                ->with('menu')
                ->firstOrFail();
        $html = '';
        $html .= '
        <div class="parameter tooltip_head">
            <h4>Thông số kĩ thuật</h4>
            <ul class="parameter-info tooltip_body">
                <li class="">
                    <span class="col-4">Loại</span>
                    <span class="col-7">' .$product->menu->name.'</span>
                </li>
                <li class=" ">
                    <span class="col-6">Công suất</span>
                    <span class="col-6">' .$results->wattage.'</span>
                </li>
                <li class="" data-index="0" data-prop="0">
                    <span class="col-2">Điều khiển</span>
                    <span class="col-10">' .$results->control.'</span>
                </li>
                <li class="" data-index="0" data-prop="0">
                    <span class="col-4">Kích thước</span>
                    <span class="">' .$results->size.'</span>
                </li>

                <li class=" ">
                    <span class="col-4">Tiện ích</span>
                    <span class="">' .$results->utilities.'</span>
                </li>
                <li class="" data-index="0" data-prop="0">
                    <span class="col-5">Thương hiệu </span>
                    <span class="">' .$results->trademark.'</span>
                </li>
                <li class="" data-index="0" data-prop="0">
                    <span class="col-4">Sản xuất </span>
                    <span class="">' .$results->produce.'</span>
                </li>
            </ul>
        </div>
        ';

        return $html; 
    }
    public static function show($products)
    {
        $html ='';
        foreach ($products as $key => $product) {
            $html .='
            <div class="card ">
                <form class="form_addcart" action="/add-cart" method="post"  >
                    <div class="card-body">
                        <div class="card-im0g">
                            <a href="/san-pham/'. $product->id .'-'. Str::slug($product->name, '-') .'.html" ><img class="img-product" src="'.$product->thumb.'" alt="..."></a>
                            <span class="sale">-'.  (int)( ( ($product->price - $product->price_sale) * 100) / $product->price ) .'%</span>
                        </div>
                        <div class="card-top">
                            <h3 class="card-title" style="text-align: center;"><a href="/san-pham/'. $product->id .'-'. Str::slug($product->name, '-') .'.html"  style="color: black;">'.$product->name.'</a></h3>
                        </div>
                        <p class="card-user">
                            <span class="moneyold">'.number_format($product->price).'đ</span>&nbsp;&nbsp;
                            <span class="moneysale">'.number_format($product->price_sale).'đ</span>
                        </p>
                        <div class="button-submit d-flex justify-content-center"><button class="bg-white border-primary text-dark" type="submit" >Mua ngay&nbsp; <i class="fa-solid fa-basket-shopping-simple"></i></button></div>
                    </div>
                    <input type="number" name="num_product" hidden value="1">
                    <input type="hidden" name="product_id" value="'. $product->id .'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                </form>
            </div>
            ';
        }
        return $html;
    }
    public static function voucher($voucher)
    {
        $html ='';
        $name_payment ='';
        foreach ($voucher as $key => $voucher) {
            if($voucher->active == 1){
                $name_payment = ($voucher->Payment == 2) ? 'thẻ tín dụng': 'tiền mặt' ;
                $price_sale = ($voucher->number <100) ?  number_format($voucher->number).'%' : number_format($voucher->number).'đ';
                $content = ($voucher->code !='NEWBER') ? 'để giảm đến' : 'dành cho người mới để giảm đến' ;
                $html .='
                <div class="control-group ">
                    <p class="product_option_item ">
                        <span class="num-ord rounded-circle">&nbsp;'.++$key.'&nbsp;</span>
                        <span class="promo_text"> Nhập mã giảm <strong>'.$voucher->code.'</strong> '.$content.' '. $price_sale .' khi thanh toán bằng '.$name_payment.' với hoá đơn từ '.number_format($voucher->limitprice).'đ .
                        </span>
                    </p>
                </div>
                ';
            }
        }
        return $html;
    }
}

