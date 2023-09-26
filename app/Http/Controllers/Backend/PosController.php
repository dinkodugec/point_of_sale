<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function Pos()
    {
        $product = Product::latest()->get();
        return view('backend.pos.pos_page',compact('product'));

    } 

}
