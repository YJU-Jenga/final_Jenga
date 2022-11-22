<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QnaController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ProductInquiryController;
use App\Http\Controllers\QAController;


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

Route::get('products', [ProductController::class, 'productList'])->name('products.list');
Route::get('product-register', [ProductController::class, 'create'])->name('product.add');
Route::get('product-detail/{type}', [ProductController::class, 'productDetail'])->name('products.detail');
Route::post('products', [ProductController::class, 'store'])->name('products.store');


Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

Route::get('/', function () {
    return view('main');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified'])->name('mypage');

Route::get('/item_use', function () {
    return view('board.item_use');
})->name('item_use');


Route::get('/write_item_use', [ItemUsePostController::class, 'create'])->name('write_item_use');

Route::post('/write_item_use', [ItemUsePostController::class, 'store'])->name('write_item_use');

Route::get('/write_q&a', [QAController::class, 'create'])->name('write_q&a');

Route::post('/write_q&a', [QAController::class, 'store'])->name('write_q&a');

Route::get('/write_product_inquiry', [ProductInquiryController::class, 'create'])->name('write_product_inquiry');

Route::post('/write_product_inquiry', [ProductInquiryController::class, 'store'])->name('write_product_inquiry');


Route::get('/product_inquiry', function () {
    return view('board.product_inquiry');
})->name('product_inquiry');

Route::get('/q&a', function () {
    return view('board.q&a');
})->name('q&a');


require __DIR__.'/auth.php';
