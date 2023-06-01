<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/logout');
    }  // from App\Http\Controllers\Auth   - AuthenticatedSessionController


    public function AdminLogoutPage()
    {
        return view('admin.admin_logout');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id; //authenticate user, that one who is login
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));

    }
}
