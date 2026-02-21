<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/',[IndexController::class,'index'])->name('index');

Route::get('/questions',[QuestionController::class,'index'])->name('questions.index');

Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function(){

    Route::get('/' , 'index')->name('index');
    Route::get('/{product}', 'show')->name('show');

});
