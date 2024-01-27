<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'dashboard','middleware'=>'verified'],function(){
    Route::get('/',[DashboardController::class,'index']);
    Route::group(['prefix'=>'products','as'=>'products.'],function(){
        Route::get('/',[ProductController::class,'index'])->name('index');
        Route::post('store',[ProductController::class,'store'])->name('store');
        //post 3lshan zy el form menf3sh hena n2olo en hygelk http request no3o get w fe el form ba3ten post f hy3ml error f hnkhly de zy el form ygelo post
        Route::get('create',[ProductController::class,'create'])->name('create');
        //{id} da kda route parameter w bst2blo fe el function ely hya el edit fe ay variable ely hwa ana msmyhah id bardo
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('edit');
        Route::put('update/{id}',[ProductController::class,'update'])->name('update');
        Route::delete('destroy/{id}',[ProductController::class,'destroy'])->name('destroy');

    });
   

});








//http://127.0.0.1.8000/dashboard/products/ =>all products
//http://127.0.0.1.8000/dashboard/products/create =>create products
//http://127.0.0.1.8000/dashboard/products/edit/id(route_parameter) =>edit products
//http://127.0.0.1.8000/dashboard/products/destroy/id(route_parameter) =>delete products


// route parameter->y3ny ba3t el id fe el url da fe el framework msh fe el native
//query string ->y3ny ba3t ?id=5 string bb3to fe el url da bykon fe el native
Auth::routes(['verify'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
