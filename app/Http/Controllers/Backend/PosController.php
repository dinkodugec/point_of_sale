<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    public function Pos()
    {
        $product = Product::latest()->get();
        $customer = Customer::latest()->get();
        return view('backend.pos.pos_page',compact('product','customer'));

    } 

    public function AddCart(Request $request){

        Cart::add([
            'id' => $request->id, 
            'name' => $request->name, 
            'qty' => $request->qty, 
            'price' => $request->price, 
            'weight' => 20, 
            'options' => ['size' => 'large']]);


         $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function AllItem()
    {

        $product_item = Cart::content();  //here are stored data from request

        return view('backend.pos.text_item',compact('product_item'));

    } 


}
