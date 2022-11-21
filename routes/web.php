<?php

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

Route::get('/product_inquiry', function () {
    return view('board.product_inquiry');
})->name('product_inquiry');

Route::get('/q&a', function () {
    return view('board.q&a');
})->name('q&a');

require __DIR__.'/auth.php';