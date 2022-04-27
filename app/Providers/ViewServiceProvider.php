<?php
 
 namespace App\Providers;
  
 use Illuminate\Support\Facades\View;
 use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\MenuComposer;

  
 class ViewServiceProvider extends ServiceProvider
 {
     /**
      * Register any application services.
      *
      * @return void
      */
     public function register()
     {
         //
     }
  
     /**
      * Bootstrap any application services.
      *
      * @return void
      */
     public function boot()
     {
        View::composer('client.layouts.menu', MenuComposer::class);
     }
 }