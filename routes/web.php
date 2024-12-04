<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubCategoryController;
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


Route::get('/',[HomeController::class,'index'])->name('home');





Route::get('shop', function () {
    return view('shop');
})->name('shop');

Route::get('product_details', function () {
    return view('product_details');
})->name('product.details');

Route::get('cart', function () {
    return view('cart');
})->name('cart');

Route::get('checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('testimonial', function () {
    return view('testimonial');
})->name('testimonial');

Route::get('contact', function () {
    return view('contact');
})->name('contact');

Route::get('admin/register', function () {
    return view('admin_panel.auth.register');
})->name('admin.register');

Route::get('admin/login',[LoginController::class,'login'])->name('login');
Route::post('admin/signin',[LoginController::class,'signin'])->name('signin');

Route::get('admin/register',[RegisterController::class,'register'])->name('admin.register');
Route::post('admin/store',[RegisterController::class,'store'])->name('admin.store');


// Middleware Start//--------------------------------------------------------------------------------

Route::middleware(['auth'])->group(function () {
    Route::get('logout',[LoginController::class,'logout'])->name('logout');

    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');

    Route::get('users/list',[UserController::class,'index'])->name('user.list');

    Route::prefix('category/')->group(function(){
        Route::get('index',[CategoryController::class,'index'])->name('category.index');
        Route::post('store',[CategoryController::class,'store'])->name('category.store');
        Route::post('status/{id}',[CategoryController::class,'status'])->name('category.status');
    });

    Route::prefix('subcategory/')->group(function(){
        Route::get('index',[SubCategoryController::class,'index'])->name('subcategory.index');
        Route::post('store',[SubCategoryController::class,'store'])->name('subcategory.store');
        Route::post('status/{id}',[SubCategoryController::class,'status'])->name('subcategory.status');
    });

    Route::prefix('proucts/')->group(function(){

        Route::get('list',[ProductController::class,'index'])->name('product.list');
        Route::get('create',[ProductController::class,'create'])->name('product.create');
        Route::post('store',[ProductController::class,'store'])->name('product.store');
        Route::post('status/{id}',[ProductController::class,'status'])->name('product.status');
    });

});
