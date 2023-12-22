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

    //new
    public function user($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user]);
    }

    //new 
    public function userCreate(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'car_number' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'birthday' => 'required|date',
            'start_working' => 'required|date',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = new User();

        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->car_number = $validatedData['car_number'];
        $user->car_model = $validatedData['car_model'];
        $user->birthday = $validatedData['birthday'];
        $user->start_working = $validatedData['start_working'];
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']);
        $user->status = true;

        $user->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function userUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'car_number' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'birthday' => 'required|date',
            'start_working' => 'required|date',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'status' => 'required|boolean',
        ]);

        $user = User::findOrFail($validatedData['user_id']);

        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->car_number = $validatedData['car_number'];
        $user->car_model = $validatedData['car_model'];
        $user->birthday = $validatedData['birthday'];
        $user->start_working = $validatedData['start_working'];
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']);
        $user->status = $validatedData['status'];

        $user->update();

        return response()->json([
            'success' => 'user is updated',
        ]);
    }

    //new
    public function userBlockUnblock($id)
    {
        $user = User::findOrFail($id);

        $user->status = $user->status ? false : true;

        $user->update();

        return response()->json([
            'success' => true,
        ]);
    }
   

    //new
    public function userDelete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'success' => true,
        ]);
    }
    
    //LAST CODE IN ESEN 

    // public function userDelete(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'user_id' => 'required',
    //     ]);

    //     $user = User::findOrFail($validatedData['user_id']);

    //     $user->delete();

    //     return response()->json([
    //         'success' => 'user is deleted',
    //     ]);
    // }

    // public function userBlockUnblock(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'user_id' => 'required',
    //         'status' => 'required|boolean',
    //     ]);

    //     $user = User::findOrFail($validatedData['user_id']);

    //     $user->status = $validatedData['status'];

    //     $user->update();

    //     if($user->status){
    //         $message = 'user is activated';
    //     } else {
    //         $message = 'user is blocked';
    //     }

    //     return response()->json([
    //         'success' => $message,
    //     ]);
    // }
}
