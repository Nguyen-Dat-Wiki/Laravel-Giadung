<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\LoginController;
use  App\Http\Controllers\MainController;
use  App\Http\Controllers\Client;
use  App\Http\Controllers\MenuController;
use  App\Http\Controllers\ProductController;
use  App\Http\Controllers\SliderController;
use  App\Http\Controllers\CartController;
use  App\Http\Controllers\UploadController;

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* admin */
Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/', [MainController::class, 'index'])->name('index');
        Route::get('main', [MainController::class, 'index']);

        Route::prefix('menu')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'edit']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::post('list', [ProductController::class, 'search']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });

        #Slider
        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });

        #Upload
        
        Route::post('upload/services', [UploadController::class, 'store']);

        #Cart
        Route::get('customers', [CartController::class, 'index']);
        Route::get('customers/view/{customer}', [CartController::class, 'show']);
        Route::DELETE('customers/destroy', [CartController::class, 'destroy']);
        
    });

});


/* client */


Route::get('/',[Client\MainController::class, 'index']);
Route::get('/Login',[Client\Login\LoginController::class, 'index']);
Route::get('danh-muc', [Client\MenuController::class, 'show']);
Route::get('danh-muc/{id}-{slug}', [Client\MenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}', [Client\ProductController::class, 'index']);

Route::post('/add-cart', [Client\CartController::class, 'index']);
Route::get('gio-hang', [Client\CartController::class, 'show']);
Route::post('gio-hang', [Client\CartController::class, 'addCart']);
Route::post('/update-cart', [Client\CartController::class, 'update']);
Route::get('gio-hang/delete/{id}', [Client\CartController::class, 'remove']);