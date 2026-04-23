<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\createProductController;
use App\Models\Product;
Route::get('/',function (){
    $products=Product::all();
    return view('product',compact('products'));
});



Route::post('/product',[createProductController::class,'createProduct'])->name('createProduct.create');

Route::put('/product/update/{id}',[createProductController::class,'update'])->name('product.update');

Route::delete('/product/delete/{id}',[createProductController::class,'delete'])->name('product.delete');

