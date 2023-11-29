<?php

namespace App\Http\Controllers\AdminControllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\RequestsUUserUpdateRequest;
use Image;
use Str;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $lang, $pagination = 10)
    {
        if($request->pagination) {
            $pagination = (int)$request->pagination;
        }

        $users = User::orderByDesc('id')->paginate($pagination);
        
        if(request()->ajax()){
            if($request->search) {
                $searchQuery = trim($request->query('search'));
                
                $requestData = ['first_name', 'last_name', 'car_number', 'car_model', 'birthday', 'start_working', 'username', 'password', 'status'];
    
                $users = User::where(function($q) use($requestData, $searchQuery) {
                                        foreach ($requestData as $field)
                                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                                })->paginate($pagination);
            }
            
            return view('admin-panel.user.user-table', compact('users', 'pagination'))->render();
        }

        return view('admin-panel.user.user', compact('users', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang, User $user)
    {
        return view('admin-panel.user.user-form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = new User;
        
        $user->first_name = ucfirst($request->first_name);
        $user->last_name = ucfirst($request->last_name);
        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->birthday = $request->birthday;
        $user->start_working = $request->start_working;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        
        $user->save();
        
        return redirect()->route('user.index', [ app()->getlocale() ])->with('success-create', 'The resource was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show($lang, User $user)
    {
        return view('admin-panel.user.user-show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, User $user)
    {
        return view('admin-panel.user.user-form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update($lang, UserUpdateRequest $request, User $user)
    {
        if($request->password != null){
            $this->validate($request, [
                'password' => 'confirmed|min:8',
            ]);

            $user->first_name = ucfirst($request->first_name);
            $user->last_name = ucfirst($request->last_name);
            $user->car_number = strtoupper($request->car_number);
            $user->car_model = $request->car_model;
            $user->birthday = $request->birthday;
            $user->start_working = $request->start_working . date(' H:i:s');
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
        } else {
            $user->first_name = ucfirst($request->first_name);
            $user->last_name = ucfirst($request->last_name);
            $user->car_number = strtoupper($request->car_number);
            $user->car_model = $request->car_model;
            $user->birthday = $request->birthday;
            $user->start_working = $request->start_working . date(' H:i:s');
            $user->username = $request->username;
            $user->status = $request->status;
        }
        
        $user->update();

        return redirect()->route('user.index', [ app()->getlocale() ])->with('success-update', 'The resource was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, User $user)
    {
        $user->delete();
    
        return redirect()->route('user.index', [ app()->getlocale() ])->with('success-delete', 'The resource was deleted!');
    }
}
