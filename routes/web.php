<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
    return view('layout/dashboard');
})->name('dashboard');

// all routes for productControler
Route::resource('product', ProductController::class);

// this route custom i use it for detach a category from specific product
Route::delete('/detach-category-from-product/{product_id}/{category_id}' , [ProductController::class  , 'detach_category_from_product'])->name('product.detach-category');

// this route custom i use it to attach a category to a specific product
Route::post('/attch-category-to-product/{id}' ,[ProductController::class  , 'attch_category_to_product'])->name('product.attch-category-to-product');

// all routes for categoryController
Route::resource('category', CategoryController::class);

// this route custom i use it for detach a category from specific product
Route::delete('/detach-product-from-category/{product_id}/{category_id}' , [CategoryController::class  , 'detach_product_from_category'])->name('category.detach-product');

// this route custom i use it to attach a category to a specific product
Route::post('/attch-product-to-category/{id}' ,[CategoryController::class  , 'attch_product_to_category'])->name('category.attch-product-to-category');