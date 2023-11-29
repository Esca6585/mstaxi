<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Travel;
use App\Models\User;

class AdminController extends Controller
{
    public function travels()
    {
        $travels = Travel::with(['user', 'tarif'])->orderBy('id', 'desc')->get();

        return response()->json([
            'travels' => $travels,
        ]);
    }

    public function users()
    {
        $users = User::orderBy('id', 'desc')->get();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function userUpdate(User $user)
    {
        
    }

    public function userBlockUnblock(User $user)
    {
        
    }

    public function userDelete(User $user)
    {
        
    }
}
