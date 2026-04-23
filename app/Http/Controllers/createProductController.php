<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class createProductController extends Controller
{

    public function createProduct(Request $Request){
        $product=new Product();

        $product->name=$Request['name'];
        $product->sku=$Request['sku'];
        $product->current_stock=$Request['current_stock'];
        $product->price=$Request['price'];
        $product->cost_price=$Request['cost_price'];
        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');
    }
}


