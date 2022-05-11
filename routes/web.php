<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\LoginController;
use  App\Http\Controllers\Client;
use  App\Http\Controllers\MenuController;
use  App\Http\Controllers\ProductController;
use  App\Http\Controllers\SliderController;
use  App\Http\Controllers\CartController;
use  App\Http\Controllers\UploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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


Route::middleware(['auth'])->group(function () {
    
    Route::prefix('admin')->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::post('/', [HomeController::class, 'post']);
        Route::get('/export',[HomeController::class, 'export']);

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
            Route::get('export',[ProductController::class, 'export']);

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
        Route::get('customers/view/{customer}/print',[CartController::class, 'print']);
        Route::post('customers/view/{customer}', [CartController::class, 'active']);
        Route::DELETE('customers/destroy', [CartController::class, 'destroy']);

        #User
        Route::get('user',[UserController::class,'index']);
        Route::get('user/view/{id}', [UserController::class, 'show']);
        Route::post('user/view/{id}', [UserController::class, 'active']);
    });
});



/* client */


Route::get('/',[Client\MainController::class, 'index'])->name('home');
Route::get('/home',[Client\MainController::class, 'index']);
Route::get('/gioi-thieu',[Client\MainController::class, 'intro']);
Route::get('/thanh-toan',[Client\MainController::class, 'pay']);
Route::get('/bao-hanh',[Client\MainController::class, 'insur']);
Route::get('/lien-he',[Client\MainController::class, 'contact']);
Route::post('/lien-he',[Client\MailController::class, 'sendMail']);


//search
Route::get('/search/autocomplete', [Client\MenuController::class, 'search'])->name('autocomplete');
Route::get('/search', [Client\MenuController::class, 'showSearch'])->name('search');

//danh muc
Route::get('danh-muc', [Client\MenuController::class, 'show']);
Route::get('danh-muc/{id}-{slug}', [Client\MenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}', [Client\ProductController::class, 'index']);

// comment
Route::post('san-pham/{id}-{slug}', [Client\ProductController::class, 'comment']);
Route::get('san-pham/{id}-{slug}/delete={post_id}', [Client\ProductController::class, 'delete']);

//cart
Route::post('/add-cart', [Client\CartController::class, 'index']);
Route::get('gio-hang', [Client\CartController::class, 'show']);
Route::post('gio-hang', [Client\CartController::class, 'addCart']);
Route::post('/update-cart', [Client\CartController::class, 'update']);
Route::get('gio-hang/delete/{id}', [Client\CartController::class, 'remove']);


//setting

Route::get('setting',[Client\SettingController::class,'index'])->name('setting');
Route::post('setting',[Client\SettingController::class,'edit']);
Route::get('setting/pass',[Client\SettingController::class,'pass'])->name('pass');
Route::post('setting/pass',[Client\SettingController::class,'update']);
Route::get('setting/{id}',[Client\SettingController::class,'show'])->name('show');
Route::get('setting/delete/{cus_id}',[Client\SettingController::class,'delete']);

//Check quyền admin/ user
Auth::routes();

Route::get('admin', [HomeController::class, 'adminHome'])->name('admin_home')->middleware('is_admin');