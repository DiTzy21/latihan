<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('pesan/{id}', [PesanController::class, 'index']);
Route::post('pesan/{id}', [PesanController::class, 'pesan']);
Route::get('check-out', [PesanController::class, 'check_out']);
Route::delete('check-out/{id}', [PesanController::class, 'delete']);
Route::post('check-out',[PesanController::class,'konfirmasi']);
Route::get('wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
Route::post('wishlist/store', [App\Http\Controllers\WishlistController::class, 'store']);
Route::delete('wishlist/delete/{id}', [App\Http\Controllers\WishlistController::class, 'delete'])->name('wishlist.delete');
Route::get('comments', [App\Http\Controllers\ProductCommentController::class, 'index'])->name('product.comments.index');
Route::post('product-comments', [App\Http\Controllers\ProductCommentController::class, 'store'])->name('product-comments.store');
Route::delete('product-comments/{id}', [App\Http\Controllers\ProductCommentController::class, 'destroy'])->name('product-comments.destroy');



// show table of product database
Route::get('admin/product', [adminController::class, 'index']);
// edit product
Route::get('/admin/productedit/{product_id}', [adminController::class,'edit']);
// update product
Route::post('admin/product',[adminController::class,'update']);
// delete data product from database
Route::delete('/admin/productdelete/{product_id}', [adminController::class, 'delete'])->name('admin.product.delete');
// show add product database
Route::get('/admin/productadd', function () {
    return view('admin.add');
})->name('admin.product.add');
// add product
Route::post('/admin/add', [adminController::class,'store']);