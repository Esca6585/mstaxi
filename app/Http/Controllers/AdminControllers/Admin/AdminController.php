<?php

namespace App\Http\Controllers\AdminControllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use Image;
use Str;
use Hash;

class AdminController extends Controller
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

        $admins = Admin::orderByDesc('id')->paginate($pagination);
        
        if(request()->ajax()){
            if($request->search) {
                $searchQuery = trim($request->query('search'));
                
                $requestData = ['first_name', 'last_name', 'username'];
                
                $admins = Admin::where(function($q) use($requestData, $searchQuery) {
                                        foreach ($requestData as $field)
                                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                                })->paginate($pagination);
            }
            
            return view('admin-panel.admin.admin-table', compact('admins', 'pagination'))->render();
        }

        return view('admin-panel.admin.admin', compact('admins', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang, Admin $admin)
    {
        return view('admin-panel.admin.admin-form', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreateRequest $request)
    {   
        $admin = new Admin;
        
        $admin->first_name = ucfirst($request->first_name);
        $admin->last_name = ucfirst($request->last_name);
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        
        $admin->save();
        
        return redirect()->route('admin.index', [ app()->getlocale() ])->with('success-create', 'The resource was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function show($lang, Admin $admin)
    {
        return view('admin-panel.admin.admin-show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Admin $admin)
    {
        return view('admin-panel.admin.admin-form', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update($lang, AdminUpdateRequest $request, Admin $admin)
    {
        if($request->password != null){
            $this->validate($request, [
                'password' => 'confirmed|min:8',
            ]);

            $admin->first_name = ucfirst($request->first_name);
            $admin->last_name = ucfirst($request->last_name);
            $admin->username = $request->username;
            $admin->password = Hash::make($request->password);
        } else {
            $admin->first_name = ucfirst($request->first_name);
            $admin->last_name = ucfirst($request->last_name);
            $admin->username = $request->username;
        }
        
        $admin->update();
        
        return redirect()->route('admin.index', [ app()->getlocale() ])->with('success-update', 'The resource was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, Admin $admin)
    {
        $admin->delete();
    
        return redirect()->route('admin.index', [ app()->getlocale() ])->with('success-delete', 'The resource was deleted!');
    }
}
