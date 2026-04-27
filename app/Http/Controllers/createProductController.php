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

//    public function createSupplier(){
//
//    }
//



    public function delete($id){
        $product=Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted successfully!');
    }


    public function update(Request $request,$id){
        $product=Product::findOrfail($id);

        $product->update([
            'name'          => $request->name,
            'sku'           => $request->sku,
            'current_stock' => $request->current_stock,
            'price'         => $request->price,
            'cost_price'    => $request->cost_price,
        ]);

        return redirect('/')->with('success', 'Product updated successfully!');
    }

}


