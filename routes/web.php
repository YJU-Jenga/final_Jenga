<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\ItemUsePostController;
use App\Http\Controllers\QAController;
use App\Http\Controllers\ProductInquiryController;
=======
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QnaController;

>>>>>>> ced5d6b (clean push)

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

<<<<<<< HEAD
Route::get('/', function () {
    return view('welcome');
})->name('/');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified'])->name('mypage');

Route::get('/item_use', function () {
    return view('board.item_use');
})->name('item_use');

Route::get('/q&a', function () {
    return view('board.q&a');
})->name('q&a');

Route::get('/product_inquiry', function () {
    return view('board.product_inquiry');
})->name('product_inquiry');

// -------------------- Q & A --------------------
// -------------------- Q & A Write --------------------
Route::get('/write_q&a', [QAController::class, 'create'])->middleware(['auth', 'verified'])->name('write_q&a');

Route::post('/write_q&a', [QAController::class, 'store'])->middleware(['auth', 'verified'])->name('write_q&a');

// -------------------- Q & A View --------------------
Route::get('/view_q&a/{id}', [QAController::class, 'viewQA'])->middleware(['auth', 'verified'])->name('view_q&a');

// -------------------- Q & A Update --------------------
Route::get('/update_q&a/{id}', [QAController::class, 'updateQA'])->middleware(['auth', 'verified'])->name('update_q&a');

Route::get('/updateok_q&a/{id}', [QAController::class, 'updateokQA'])->middleware(['auth', 'verified'])->name('updateok_q&a');
Route::post('/updateok_q&a/{id}', [QAController::class, 'updateok'])->middleware(['auth', 'verified'])->name('updateok_q&a');

// -------------------- Q & A Delete --------------------
Route::get('/deleteck_q&a/{id}', [QAController::class, 'deleteck'])->middleware(['auth', 'verified'])->name('deleteck_q&a');

Route::get('/delete_q&a/{id}', [QAController::class, 'deleteQA'])->middleware(['auth', 'verified'])->name('delete_q&a');


// -------------------- Item_use --------------------
// -------------------- Item_use Write --------------------
Route::get('/write_item_use', [ItemUsePostController::class, 'create'])->middleware(['auth', 'verified'])->name('write_item_use');

Route::post('/write_item_use', [ItemUsePostController::class, 'store'])->middleware(['auth', 'verified'])->name('write_item_use');

Route::get('/view_item_use/{id}', [ItemUsePostController::class, 'viewItemUse'])->name('view_item_use');

Route::get('/update_item_use/{id}', [ItemUsePostController::class, 'updateItemUse'])->middleware(['auth', 'verified'])->name('update_item_use');

Route::get('/updateok_item_use/{id}', [ItemUsePostController::class, 'updateokItemUse'])->middleware(['auth', 'verified'])->name('updateok_item_use');
Route::post('/updateok_item_use/{id}', [ItemUsePostController::class, 'updateok'])->middleware(['auth', 'verified'])->name('updateok_item_use');

Route::get('/deleteck_item_use/{id}', [ItemUsePostController::class, 'deleteckItemUse'])->middleware(['auth', 'verified'])->name('delete_item_use');

Route::get('/delete_item_use/{id}', [ItemUsePostController::class, 'deleteItemUse'])->middleware(['auth', 'verified'])->name('delete_item_use');


// -------------------- Product_inquiry --------------------
Route::get('/write_product_inquiry', [ProductInquiryController::class, 'create'])->middleware(['auth', 'verified'])->name('write_product_inquiry');

Route::post('/write_product_inquiry', [ProductInquiryController::class, 'store'])->middleware(['auth', 'verified'])->name('write_product_inquiry');


require __DIR__ . '/auth.php';
=======
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('products', [ProductController::class, 'productList'])->name('products.list');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::get('mypage', function(){
    return view('mypage');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
>>>>>>> ced5d6b (clean push)
