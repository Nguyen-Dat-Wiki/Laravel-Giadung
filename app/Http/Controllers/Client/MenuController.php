<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(Request $request, $id, $slug = '')
    {
        $menu = $this->menuService->getId($id);
        $menus = $this->menuService->getChill_id($id);
        $products = $this->menuService->getProduct($menus, $request);

        return view('client.category', [
            'title' => 'Sản phẩm',
            'title2' => $menu->name,
            'products' => $products,
            'menu'  => $menu
        ]);
    }
    public function show(Request $request)
    {
        $products = $this->menuService->getProductAll($request);

        return view('client.category', [
            'title' => 'Sản phẩm',
            'products' => $products,
        ]);
    }
}
