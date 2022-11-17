<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QnaController;
use App\Http\Controllers\TaskController;


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
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('tasks/create', [TaskController::class, 'create']);
Route::post('tasks', [TaskController::class, 'store']);
// Route::get('/tasks', 'App\Http\Controllers\TaskController@index'); // 메인페이지
// Route::get('/tasks/create', 'App\Http\Controllers\TaskController@create'); // 글 작성
// Route::post('/tasks', 'App\Http\Controllers\TaskController@store');

Route::get('/', function () {
    return view('welcome');
})->name('/');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified'])->name('mypage');

require __DIR__.'/auth.php';
