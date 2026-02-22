<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/aboutUs', function () { return view('about-us');
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
