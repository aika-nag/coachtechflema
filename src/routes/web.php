<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
Route::middleware(['auth', 'verified'])->group(function(){
    Route::post('/item/{item_id}/favorite', [ItemController::class, 'favorite']);
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::post('/sell', [ItemController::class, 'create']);
    Route::get('/mypage', [ProfileController::class, 'myPage']);
    Route::post('/mypage', [ProfileController::class, 'sellBuyItem']);
    Route::post('/mypage/profile', [ProfileController::class, 'store']);
    Route::get('/mypage/profile', [ProfileController::class, 'index']);
    Route::post('/item/{item_id}/comments', [CommentController::class, 'store']);
    Route::get('/purchase/{item}', [OrderController::class, 'purchase']);
    Route::post('/purchase/{item_id}', [OrderController::class, 'order']);
    Route::post('/purchase/address/{item_id}', [OrderController::class, 'changeAddress']);
    Route::get('/purchase/address/{item_id}', [OrderController::class, 'editAddress']);
});

Route::get('/', [ItemController::class, 'index']);
Route::get('/login', [Controller::class, 'login'])->name('login');
Route::get('/item/{item_id}', [ItemController::class,'detail']);

Route::post('/item/find', [ItemController::class, 'search']);
Route::post('/', [ItemController::class, 'myList']);



