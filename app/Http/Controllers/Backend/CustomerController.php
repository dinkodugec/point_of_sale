<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function AllCustomer()
    {

        $customer = Customer::latest()->get();
        return view('backend.customer.all_customer',compact('customer'));
    } 

}
