<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:8'
        ]);
        
        // Attempt to log the user in
        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)){
            // If successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard', app()->getLocale()));
        }
        // If unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
