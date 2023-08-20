<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Intervention\Image\Facades\Image;
use Carbon\Carbon; 

class ProductController extends Controller
{
   public function AllProduct()
   {

    $product = Product::latest()->get();
    return view('backend.product.all_product',compact('product'));

   } 

   public function AddProduct()
   {

      $category = Category::latest()->get();
      $supplier = Supplier::latest()->get();
      return view('backend.product.add_product',compact('category','supplier'));
     }





}