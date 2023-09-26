<?php

namespace App\Http\Controllers\AdminControllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Requests\DriverCreateRequest;
use App\Http\Requests\DriverUpdateRequest;
use Image;
use Str;
use Hash;

class DriverController extends Controller
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

        $drivers = Driver::orderByDesc('id')->paginate($pagination);
        
        if(request()->ajax()){
            if($request->search) {
                $searchQuery = trim($request->query('search'));
                
                $requestData = ['first_name', 'last_name', 'car_number', 'car_model', 'birthday', 'start_working', 'username', 'password', 'status'];
    
                $drivers = Driver::where(function($q) use($requestData, $searchQuery) {
                                        foreach ($requestData as $field)
                                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                                })->paginate($pagination);
            }
            
            return view('admin-panel.driver.driver-table', compact('drivers', 'pagination'))->render();
        }

        return view('admin-panel.driver.driver', compact('drivers', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang, Driver $driver)
    {
        return view('admin-panel.driver.driver-form', compact('driver'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverCreateRequest $request)
    {
        if($request->file('image')){
            $image = $request->file('image');
            
            $date = date("d-m-Y H-i-s");
            
            $fileRandName = Str::random(10);
            $fileExt = $image->getClientOriginalExtension();

            $fileName = $fileRandName . '.' . $fileExt;
            
            $path = 'assets/brand/' . Str::slug($request->name . '-' . $date ) . '/';

            $image->move($path, $fileName);
            
            $originalImage = $path . $fileName;
        }
        
        $driver = new Driver;
        
        $driver->first_name = ucfirst($request->first_name);
        $driver->last_name = ucfirst($request->last_name);
        $driver->car_number = $request->car_number;
        $driver->car_model = $request->car_model;
        $driver->birthday = $request->birthday;
        $driver->start_working = $request->start_working;
        $driver->username = $request->username;
        $driver->password = $request->password;
        $driver->status = $request->status;
        
        $driver->save();
        
        return redirect()->route('driver.index', [ app()->getlocale() ])->with('success-create', 'The resource was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function show($lang, Driver $driver)
    {
        return view('admin-panel.driver.driver-show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Driver $driver)
    {
        return view('admin-panel.driver.driver-form', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update($lang, DriverUpdateRequest $request, Driver $driver)
    {
        if(Driver::where('username', $request->username)->where('id', $driver->id)->exists()) {

            if($request->password != null){
                $this->validate($request, [
                    'password' => 'confirmed|min:8',
                ]);

                $driver->first_name = ucfirst($request->first_name);
                $driver->last_name = ucfirst($request->last_name);
                $driver->car_number = strtoupper($request->car_number);
                $driver->car_model = $request->car_model;
                $driver->birthday = $request->birthday;
                $driver->start_working = $request->start_working . date(' H:i:s');
                $driver->username = $request->username;
                $driver->password = Hash::make($request->password);
                $driver->status = $request->status;
            } else {
                $driver->first_name = ucfirst($request->first_name);
                $driver->last_name = ucfirst($request->last_name);
                $driver->car_number = strtoupper($request->car_number);
                $driver->car_model = $request->car_model;
                $driver->birthday = $request->birthday;
                $driver->start_working = $request->start_working . date(' H:i:s');
                $driver->username = $request->username;
                $driver->status = $request->status;
            }
            
            $driver->update();
            
            return redirect()->route('driver.index', [ app()->getlocale() ])->with('success-update', 'The resource was updated!');
        } else {
            return redirect()->route('driver.index', [ app()->getlocale() ])->with('warning', 'This Username already is exist!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, Driver $driver)
    {
        $driver->delete();
    
        return redirect()->route('driver.index', [ app()->getlocale() ])->with('success-delete', 'The resource was deleted!');
    }
}
