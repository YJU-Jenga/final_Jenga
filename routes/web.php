<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QnaController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ProductInquiryController;
use App\Http\Controllers\QAController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ItemUsePostController;




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

// -------------------- Product --------------------
Route::get('products', [ProductController::class, 'productList'])->name('products.list');
Route::get('product-register', [ProductController::class, 'create'])->name('product.add');
Route::get('product-detail/{type}', [ProductController::class, 'productDetail'])->name('products.detail');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
// -------------------- Product --------------------


// -------------------- Cart --------------------
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
// -------------------- Cart --------------------

Route::get('/', function () {
    return view('main');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified'])->name('mypage');

// -------------------- Item_use --------------------
Route::get('/item_use', function () {
    return view('board.item_use');
})->name('item_use');
// -------------------- Item_use Write --------------------
Route::get('/write_item_use', [ItemUsePostController::class, 'create'])->middleware(['auth', 'verified'])->name('write_item_use');
Route::post('/write_item_use', [ItemUsePostController::class, 'store'])->middleware(['auth', 'verified'])->name('write_item_use');

// -------------------- Item_use View --------------------
Route::get('/view_item_use/{id}', [ItemUsePostController::class, 'viewItemUse'])->name('view_item_use');

// -------------------- Item_use Update --------------------
Route::get('/update_item_use/{id}', [ItemUsePostController::class, 'updateItemUse'])->middleware(['auth', 'verified'])->name('update_item_use');

Route::post('/updateok_item_use/{id}', [ItemUsePostController::class, 'updateok'])->middleware(['auth', 'verified'])->name('updateok_item_use');
Route::get('/updateok_item_use/{id}', [ItemUsePostController::class, 'updateokItemUse'])->middleware(['auth', 'verified'])->name('updateok_item_use');

// -------------------- Item_use Delete --------------------
Route::get('/delete_item_use/{id}', [ItemUsePostController::class, 'deleteItemUse'])->middleware(['auth', 'verified'])->name('delete_item_use');
Route::get('/deleteck_item_use/{id}', [ItemUsePostController::class, 'deleteckItemUse'])->middleware(['auth', 'verified'])->name('delete_item_use');
// -------------------- Item_use --------------------

// -------------------- Q & A --------------------
Route::get('/q&a', function () {
    return view('board.q&a');
})->name('q&a');
// -------------------- Q & A Write --------------------
Route::get('/write_q&a', [QAController::class, 'create'])->middleware(['auth', 'verified'])->name('write_q&a');
Route::post('/write_q&a', [QAController::class, 'store'])->middleware(['auth', 'verified'])->name('write_q&a');

// -------------------- Q & A View --------------------
Route::get('/view_q&a/{id}', [QAController::class, 'viewQA'])->name('view_q&a');

// -------------------- Q & A Update --------------------
Route::get('/update_q&a/{id}', [QAController::class, 'updateQA'])->middleware(['auth', 'verified'])->name('update_q&a');

Route::post('/updateok_q&a/{id}', [QAController::class, 'updateok'])->middleware(['auth', 'verified'])->name('updateok_q&a');
Route::get('/updateok_q&a/{id}', [QAController::class, 'updateokQA'])->middleware(['auth', 'verified'])->name('updateok_q&a');

// -------------------- Q & A Delete --------------------
Route::get('/delete_q&a/{id}', [QAController::class, 'deleteQA'])->middleware(['auth', 'verified'])->name('delete_q&a');
Route::get('/deleteck_q&a/{id}', [QAController::class, 'deleteck'])->middleware(['auth', 'verified'])->name('deleteck_q&a');
// -------------------- Q & A --------------------

// -------------------- Product_inquiry --------------------
Route::get('/product_inquiry', function () {
    return view('board.product_inquiry');
})->name('product_inquiry');
// -------------------- Product_inquiry Write --------------------
Route::get('/write_product_inquiry', [ProductInquiryController::class, 'create'])->middleware(['auth', 'verified'])->name('write_product_inquiry');
Route::post('/write_product_inquiry', [ProductInquiryController::class, 'store'])->middleware(['auth', 'verified'])->name('write_product_inquiry');

// -------------------- Product_inquiry View --------------------
Route::get('/view_product_inquiry/{id}', [ProductInquiryController::class, 'viewProductInquiry'])->name('view_q&a');
// -------------------- Product_inquiry Update --------------------
Route::get('/update_product_inquiry/{id}', [ProductInquiryController::class, 'updateProductInquiry'])->middleware(['auth', 'verified'])->name('update_q&a');

Route::post('/updateok_product_inquiry/{id}', [ProductInquiryController::class, 'updateok'])->middleware(['auth', 'verified'])->name('updateok_q&a');
Route::get('/updateok_product_inquiry/{id}', [ProductInquiryController::class, 'updateokProductInquiry'])->middleware(['auth', 'verified'])->name('updateok_q&a');
// -------------------- Product_inquiry Delete --------------------
Route::get('/delete_product_inquiry/{id}', [ProductInquiryController::class, 'deleteProductInquiry'])->middleware(['auth', 'verified'])->name('delete_q&a');
Route::get('/deleteck_product_inquiry/{id}', [ProductInquiryController::class, 'deleteck'])->middleware(['auth', 'verified'])->name('deleteck_q&a');
// -------------------- Product_inquiry --------------------


// -------------------- Order --------------------
Route::get('/order', [OrderController::class, 'index'])->middleware(['auth','verified'])->name('order');

Route::post('order_success', [OrderController::class, 'store'])->middleware(['auth','verified'])->name('order_success');
Route::get('/order_completed', function () {
    return view('order_completed');
})->name('order.completed');

require __DIR__.'/auth.php';
