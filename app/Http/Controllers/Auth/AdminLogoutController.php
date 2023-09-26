<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLogoutController extends Controller
{
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login', app()->getlocale());
    }

}
