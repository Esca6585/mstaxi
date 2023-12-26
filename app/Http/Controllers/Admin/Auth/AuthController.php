<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $admin = Admin::where('username', $request['username'])->firstOrFail();

        $token = $admin->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout()
    {
        $tokenId = Str::before(request()->bearerToken(), '|');
        
        auth()->user()->tokens()->where('id', $tokenId )->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
