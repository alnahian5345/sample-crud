<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    return view('product');});


Route::post('/product',[createProductController::class,'createProduct'])->name('createProduct.create');
