<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function AllEmployee()
    {

        $employee = Employee::latest()->get();
        return view('backend.employee.allEmployee', compact('employee'));
    } 

    public function AddEmployee()
    {
        return view('backend.employee.addEmployee');
    } 
}
