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
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;




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

// -------------------- Main --------------------
Route::get('/', function () {
    return view('main');
})->name('/');;
// -------------------- Main --------------------

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified'])->name('mypage');

Route::get('/customizing', function () {
    return view('customizing');
})->middleware(['auth', 'verified'])->name('customizing');

// -------------------- Product --------------------
Route::get('products', [ProductController::class, 'productList'])->name('products.list');
Route::get('product-register', [ProductController::class, 'create'])->name('product.add');
Route::get('product-detail/{type}', [ProductController::class, 'productDetail'])->name('products.detail');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
// -------------------- Product --------------------

// -------------------- Cart --------------------
Route::get('cart', [CartController::class, 'cartList'])->middleware(['auth', 'verified'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->middleware(['auth', 'verified'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->middleware(['auth', 'verified'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->middleware(['auth', 'verified'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->middleware(['auth', 'verified'])->name('cart.clear');
// -------------------- Cart --------------------

// -------------------- Order --------------------
Route::get('/order', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('order');
Route::post('order_success', [OrderController::class, 'store'])->middleware(['auth', 'verified'])->name('order_success');
Route::get('/order_completed', function () {
    return view('order_completed');
})->name('order.completed');
// -------------------- Order_Manage --------------------
Route::get('/order_management', [OrderController::class, 'manage'])->middleware(['auth', 'verified'])->name('order_manage');

Route::post('/update_order/{id}', [OrderController::class, 'update'])->middleware(['auth', 'verified'])->name('order_update');
Route::post('/delete_order/{id}', [OrderController::class, 'delete'])->middleware(['auth', 'verified'])->name('order_delete');
// -------------------- Order --------------------

// <-------------------- Board_Posts -------------------->
// -------------------- Item_use --------------------
Route::get('/item_use', [ItemUsePostController::class, 'index'])->name('item_use');

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
Route::get('/q&a', [QAController::class, 'index'])->name('q&a');

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
Route::get('/product_inquiry', [ProductInquiryController::class, 'index'])->name('product_inquiry');

// -------------------- Product_inquiry Write --------------------
Route::get('/write_product_inquiry', [ProductInquiryController::class, 'create'])->middleware(['auth', 'verified'])->name('write_product_inquiry');
Route::post('/write_product_inquiry', [ProductInquiryController::class, 'store'])->middleware(['auth', 'verified'])->name('write_product_inquiry');

// -------------------- Product_inquiry View --------------------
Route::get('/view_product_inquiry/{id}', [ProductInquiryController::class, 'viewProductInquiry'])->name('view_product_inquiry');
// -------------------- Product_inquiry Update --------------------
Route::get('/update_product_inquiry/{id}', [ProductInquiryController::class, 'updateProductInquiry'])->middleware(['auth', 'verified'])->name('update_product_inquiry');

Route::post('/updateok_product_inquiry/{id}', [ProductInquiryController::class, 'updateok'])->middleware(['auth', 'verified'])->name('updateok_product_inquiry');
Route::get('/updateok_product_inquiry/{id}', [ProductInquiryController::class, 'updateokProductInquiry'])->middleware(['auth', 'verified'])->name('updateok_product_inquiry');
// -------------------- Product_inquiry Delete --------------------
Route::get('/delete_product_inquiry/{id}', [ProductInquiryController::class, 'deleteProductInquiry'])->middleware(['auth', 'verified'])->name('delete_product_inquiry');
Route::get('/deleteck_product_inquiry/{id}', [ProductInquiryController::class, 'deleteck'])->middleware(['auth', 'verified'])->name('deleteck_product_inquiry');
// -------------------- Product_inquiry --------------------
// -------------------- comment_write --------------------
Route::get('/comment_write', [CommentController::class, 'create'])->middleware(['auth', 'verified'])->name('comment_write');
Route::post('/comment_write', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comment_write');
// <-------------------- Board_Posts -------------------->

Route::get('/comment_delete/{id}', [CommentController::class, 'delete'])->middleware(['auth', 'verified'])->name('comment_delete');
Route::get('/comment_update/{id}', [CommentController::class, 'update'])->middleware(['auth', 'verified'])->name('comment_delete');
Route::get('/updateok_comment/{id}', [CommentController::class, 'updateok'])->middleware(['auth', 'verified'])->name('updateok_product_inquiry');

// -------------------- Secret --------------------
Route::get('/secret_post/{id}', [PostController::class, 'secretView'])->name('secret_post');
// -------------------- Secret --------------------

require __DIR__ . '/auth.php';