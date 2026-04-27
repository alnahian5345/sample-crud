<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\createProductController;
use App\Http\Controllers\createSupplierController;
use App\Models\Product;
use App\Models\Supplier;

Route::get('/',function (){
    $products=Product::all();
    return view('product',compact('products'));
});


Route::get('/supplier',function (){
    return view('supplier');
});


//Route::get('/supplier',[createProductController::class,'createSupplier'])->name('createSupplier.create');

Route::post('/product',[createProductController::class,'createProduct'])->name('createProduct.create');
Route::put('/product/update/{id}',[createProductController::class,'update'])->name('product.update');
Route::delete('/product/delete/{id}',[createProductController::class,'delete'])->name('product.delete');

Route::post('/supplier',[createSupplierController::class,'createSupplier'])->name('createSupplier.create');
