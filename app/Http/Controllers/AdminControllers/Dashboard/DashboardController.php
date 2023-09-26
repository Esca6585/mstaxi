<?php

namespace App\Http\Controllers\AdminControllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($categoryType)
    {
        return view('admin-panel.dashboard.dashboard', compact('categoryType'));
    }
}
