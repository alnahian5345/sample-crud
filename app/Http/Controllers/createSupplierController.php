<?php
namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class createSupplierController extends controller{
    public function createSupplier(Request $Request){
        $suppliers=new supplier();

        $suppliers->name=$Request['name'];
        $suppliers->email=$Request['email'];
        $suppliers->phone=$Request['phone'];
        $suppliers->address=$Request['address'];
        $suppliers->company_name=$Request['company_name'];
        $suppliers->save();
        return redirect()->back()->with('success','Successfully Supplier Added');
    }
}
