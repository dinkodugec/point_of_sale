<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'info'
        );


        return redirect('/logout')->with($notification);
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

    public function AdminProfileStore(Request $request)
    {
       
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName(); //image unique name
            $file->move(public_path('upload/admin_image'), $filename);
            $data['photo']= $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function ChangePassword()
    {
        return view('admin.change_password');
    }

    public function UpdatePassword(Request $request){

        /// Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',

        ]);

        /// Match The Old Password 
        if (!Hash::check($request->old_password, auth::user()->password)) {

             $notification = array(
            'message' => 'Old Password Dones not Match!!',
            'alert-type' => 'error'
             ); 
            return back()->with($notification);

        }

        //// Update The New Password 

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

            $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
             ); 
            return back()->with($notification);

    }// End Method 
}
