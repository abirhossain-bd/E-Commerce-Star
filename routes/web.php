<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\SpeacialOfferController;
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
Route::get('shop',[HomeController::class,'shop'])->name('shop');





Route::get('product/details',[ProductDetailsController::class,'index'])->name('product.details');

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
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('update/{id}',[CategoryController::class,'update'])->name('category.update');
        Route::post('delete/{id}',[CategoryController::class,'destroy'])->name('category.delete');
        Route::post('status/{id}',[CategoryController::class,'status'])->name('category.status');
    });

    Route::prefix('subcategory/')->group(function(){
        Route::get('index',[SubCategoryController::class,'index'])->name('subcategory.index');
        Route::post('store',[SubCategoryController::class,'store'])->name('subcategory.store');
        Route::get('edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
        Route::post('update/{id}',[SubCategoryController::class,'update'])->name('subcategory.update');
        Route::post('delete/{id}',[SubCategoryController::class,'destroy'])->name('subcategory.delete');
        Route::post('status/{id}',[SubCategoryController::class,'status'])->name('subcategory.status');
    });

    Route::prefix('proucts/')->group(function(){

        Route::get('list',[ProductController::class,'index'])->name('product.list');
        Route::get('create',[ProductController::class,'create'])->name('product.create');
        Route::post('store',[ProductController::class,'store'])->name('product.store');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('product.edit');
        Route::post('update/{id}',[ProductController::class,'update'])->name('product.update');
        Route::post('delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
        Route::post('status/{id}',[ProductController::class,'status'])->name('product.status');
    });


    Route::get('cart',[CartController::class,'index'])->name('cart');
    Route::get('add/cart',[CartController::class,'addCart'])->name('add.cart');
    Route::get('update/cart',[CartController::class,'updateCart'])->name('update.cart');
    Route::get('remove/cart',[CartController::class,'removeCart'])->name('remove.cart');
    Route::get('total/payout',[CartController::class,'totalPayout'])->name('total.payout');


    Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');


    Route::get('offer/list',[SpeacialOfferController::class,'index'])->name('offer.list');
    Route::get('offer/create',[SpeacialOfferController::class,'offerCreate'])->name('offer.create');
    Route::post('offer/store',[SpeacialOfferController::class,'store'])->name('offer.store');
    Route::get('offer/edit/{id}',[SpeacialOfferController::class,'edit'])->name('offer.edit');
    Route::post('offer/update/{id}',[SpeacialOfferController::class,'update'])->name('offer.update');
    Route::post('offer/delete/{id}',[SpeacialOfferController::class,'destroy'])->name('offer.delete');
    Route::post('offer/status/{id}',[SpeacialOfferController::class,'status'])->name('offer.status');


});
