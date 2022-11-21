<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QnaController;
use App\Http\Controllers\BoardController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('products', [ProductController::class, 'productList'])->name('products.list');
Route::get('product-register', [ProductController::class, 'create'])->name('product.add');
Route::get('product-detail/{type}', [ProductController::class, 'productDetail'])->name('products.detail');
// Route::controller(ProductController::class)->group(function(){
//     Route::get('/image-upload', 'index')->name('image.form');
//     Route::post('/upload-image', 'storeImage')->name('image.store');
// });
Route::post('products', [ProductController::class, 'store'])->name('products.store');


Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

Route::get('boards', [BoardController::class, 'index'])->name('boards.index');
Route::get('boards/create', [BoardController::class, 'create']);
Route::post('boards', [BoardController::class, 'store']);

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified'])->name('mypage');

require __DIR__.'/auth.php';
