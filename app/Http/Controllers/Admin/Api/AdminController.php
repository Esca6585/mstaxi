<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Travel;
use App\Models\Tarif;
use App\Models\User;
use Str;
use DB;

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

    public function userStatistic()
    {
        $users = \DB::table('users')
                    ->join('travels', function ($q) {
                        $q->on('travels.user_id','=','users.id');
                    })
                    ->select('users.id', 'travels.user_id', 'users.first_name', 'users.last_name', 'users.status', 'users.online', 'users.time', \DB::raw('sum(travels.km) as all_km'), DB::raw('sum(travels.price) as all_price'))
                    ->groupBy('users.id', 'travels.user_id', 'users.first_name', 'users.last_name', 'users.status', 'users.online', 'users.time')
                    ->get();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function user($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user]);
    }

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
            'success' => true,
        ]);
    }

    public function userBlockUnblock($id)
    {
        $user = User::findOrFail($id);

        $user->status = $user->status ? false : true;

        $user->update();

        return response()->json([
            'success' => true,
        ]);
    }
   
    public function userDelete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function tarif($id)
    {
        $tarif = Tarif::findOrFail($id);
        return response()->json(['tarif' => $tarif]);
    }

    public function tarifCreate(Request $request)
    {
        $validatedData = $request->validate([
            'name_tm' => 'required',
            'name_ru' => 'required',
            'minimum_price' => 'required',
            'every_minute_price' => 'required',
            'every_km_price' => 'required',
            'every_waiting_price' => 'required',
            'free_waiting_minute' => 'required',
            'every_minute_price_outside' => 'required',
            'every_km_price_outside' => 'required',
            'additional_tarif' => 'required',
        ]);

        if($request->file('image')){
            $image = $request->file('image');
            
            $date = date("d-m-Y H-i-s");
            
            $fileRandName = Str::random(10);
            $fileExt = $image->getClientOriginalExtension();

            $fileName = $fileRandName . '.' . $fileExt;
            
            $path = 'assets/tarif/' . Str::slug($request->name_tm . '-' . $date ) . '/';

            $image->move($path, $fileName);
            
            $originalImage = $path . $fileName;
        }

        $tarif = new Tarif();

        $tarif->name_tm = $validatedData['name_tm'];
        $tarif->name_ru = $validatedData['name_ru'];
        $tarif->minimum_price = $validatedData['minimum_price'];
        $tarif->every_minute_price = $validatedData['every_minute_price'];
        $tarif->every_km_price = $validatedData['every_km_price'];
        $tarif->every_waiting_price = $validatedData['every_waiting_price'];
        $tarif->free_waiting_minute = $validatedData['free_waiting_minute'];
        $tarif->every_minute_price_outside = $validatedData['every_minute_price_outside'];
        $tarif->every_km_price_outside = $validatedData['every_km_price_outside'];
        $tarif->additional_tarif = $validatedData['additional_tarif'];
        $tarif->image = $originalImage ?? null;

        $tarif->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function tarifUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'tarif_id' => 'required',
            'name_tm' => 'required',
            'name_ru' => 'required',
            'minimum_price' => 'required',
            'every_minute_price' => 'required',
            'every_km_price' => 'required',
            'every_waiting_price' => 'required',
            'free_waiting_minute' => 'required',
            'every_minute_price_outside' => 'required',
            'every_km_price_outside' => 'required',
            'additional_tarif' => 'required',
        ]);

        $tarif = Tarif::findOrFail($validatedData['tarif_id']);

        if($request->file('image')){
            
            $this->deleteFolder($tarif);

            $image = $request->file('image');
            
            $date = date("d-m-Y H-i-s");
            
            $fileRandName = Str::random(10);
            $fileExt = $image->getClientOriginalExtension();

            $fileName = $fileRandName . '.' . $fileExt;
            
            $path = 'assets/tarif/' . Str::slug($request->name_tm . '-' . $date . '-updated' ) . '/';

            $image->move($path, $fileName);
            
            $originalImage = $path . $fileName;

            $tarif->image = $originalImage;
        }

        $tarif->name_tm = $validatedData['name_tm'];
        $tarif->name_ru = $validatedData['name_ru'];
        $tarif->minimum_price = $validatedData['minimum_price'];
        $tarif->every_minute_price = $validatedData['every_minute_price'];
        $tarif->every_km_price = $validatedData['every_km_price'];
        $tarif->every_waiting_price = $validatedData['every_waiting_price'];
        $tarif->free_waiting_minute = $validatedData['free_waiting_minute'];
        $tarif->every_minute_price_outside = $validatedData['every_minute_price_outside'];
        $tarif->every_km_price_outside = $validatedData['every_km_price_outside'];
        $tarif->additional_tarif = $validatedData['additional_tarif'];

        $tarif->update();

        return response()->json([
            'success' => true,
        ]);
    }
   
    public function tarifDelete($id)
    {
        $tarif = Tarif::findOrFail($id);

        $this->deleteFolder($tarif);

        $tarif->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function deleteFolder($tarif)
    {
        if($tarif->image){
            $folder = explode('/', $tarif->image);

            if($folder[2] != 'tarif-seeder'){
                \File::deleteDirectory($folder[0] . '/' . $folder[1] . '/' . $folder[2]);
            }
        }
    }
}
