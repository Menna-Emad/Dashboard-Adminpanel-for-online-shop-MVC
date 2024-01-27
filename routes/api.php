<?php

use App\Http\Controllers\Apis\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 127.0.0.1.8000/api/v1/test  da el api url
// Route::get('test',function(){
//     echo "test";
// });

//msh ha3ml name 3lshan msh ha7tghom 3lshan ba3ml apis
//3lshan msh ana ely haroh anady 3la el routes 3aks el web aw el server 3lshan ana ely bandah 3lehom
Route::prefix('products')->group(function () {
    Route::get('/',[ProductController::class,'index']);
    Route::get('/create',[ProductController::class,'create']);
    Route::get('/edit/{id}',[ProductController::class,'edit']);
    //hn3ml url tany aw route esmha store 3lshan lma ados 3la create akhznha
    //bs no3ha post 3lshan lma ados 3la el zorar tshtaghl w el data ely htgely fe el body ha3ml 3leha validate
    Route::post('/store',[ProductController::class,'store']);
    Route::put('/update/{id}',[ProductController::class,'update']);
    Route::delete('/destroy/{id}',[ProductController::class,'destroy']);
});
