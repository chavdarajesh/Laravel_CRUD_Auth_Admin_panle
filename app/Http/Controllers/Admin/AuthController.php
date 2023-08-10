<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function adminloginget()
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.get.company')->with('message', 'Admin Login Successfully');
            } else {
                return redirect()->route('front.homepage')->with('error', 'User Not Acees Admin Site..!');
            }
        } else {
            return view('admin.auth.login');
        }
    }
    public function adminloginpost(Request $request)
    {
        $request->validate([
            'adminpassword' => 'required | min:6',
            'adminemail' => 'required'
        ]);
        if (!Auth::check()) {
            if (Auth::attempt(['email' => $request->adminemail, 'password' => $request->adminpassword])) {
                if (Auth::user()->is_admin == 1) {
                    return redirect()->route('admin.get.company')->with('message', 'Admin Login Successfully');
                } else {
                    return redirect()->back()->with('error', 'You have not Admin access');
                }
            } else {
                return redirect()->route('admin.login')->with('error', 'Invalid Credantials');
            }

        } else {
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.get.company')->with('message', 'Admin Login Successfully');
            } else {
                return redirect()->route('front.homepage')->with('error', 'User Not Acees Admin Site..!');
            }
        }

    }
    
    public function adminlogout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('admin.login')->with('message', 'Admin Logout Successfully');
        ;
    }
}