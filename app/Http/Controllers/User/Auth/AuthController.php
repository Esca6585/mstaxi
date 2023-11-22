<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'car_number' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'birthday' => 'required|date',
            'start_working' => 'required|date',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|boolean',
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'car_number' => $validatedData['car_number'],
            'car_model' => $validatedData['car_model'],
            'birthday' => $validatedData['birthday'],
            'start_working' => $validatedData['start_working'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'status' => $validatedData['status'],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = User::where('username', $request['username'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

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
            'token' => 'Your token is deleted!',
        ]);
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
