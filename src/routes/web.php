<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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
Route::middleware('auth')->group(function(){
    Route::get('/', [ItemController::class, 'index']);
    Route::post('/item/{item_id}/favorite', [ItemController::class, 'favorite']);
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::post('/', [ItemController::class, 'mylist']);
    Route::get('/mypage/profile', [ProfileController::class, 'index']);
});

Route::get('/item/{item_id}', [ItemController::class,'detail']);

Route::post('/item/find', [ItemController::class, 'search']);



