<?php

use App\Http\Controllers\Account\EditProfileController;
use App\Http\Controllers\Account\OrderController as AccountOrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/aboutUs', function () {
    return view('about-us');
})->name('about-us');

Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');

Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/{product}', 'show')->name('show');

});

Route::prefix('contactUs')->name('contactUs.')->controller(ContactUsController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'post')->name('post');

});

Route::prefix('account')->name('account.')->middleware('auth')->group(function () {

    Route::get('orders', [AccountOrderController::class, 'index'])->name('orders');

    Route::prefix('edit-profile')->name('edit-profile.')->controller(EditProfileController::class)->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/', 'post')->name('post');

    });
});

Route::prefix('cart')->name('cart.')->middleware('auth')->controller(CartController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('add', 'add')->name('add');

    Route::get('{productId}/remove', 'removeItem')->name('remove-item');
    Route::get('clear', 'clear')->name('clear');


    Route::post('update-qty', 'updateQty')->name('update-qty');

});

Route::prefix('checkout')->name('checkout.')->middleware('auth')->controller(CheckoutController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'post')->name('post');

});


