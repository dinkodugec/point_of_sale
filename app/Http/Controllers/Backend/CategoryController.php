<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AllCategory()
    {

        $category = Category::latest()->get();
        return view('backend.category.all_category',compact('category'));

    }

    
    public function StoreCategory(Request $request)
    {

        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

         $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);  
    }
}
