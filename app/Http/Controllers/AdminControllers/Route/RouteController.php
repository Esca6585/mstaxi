<?php

namespace App\Http\Controllers\AdminControllers\Route;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Requests\RouteCreateRequest;
use App\Http\Requests\RouteUpdateRequest;
use Image;
use Str;
use Hash;

class RouteController extends Controller
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

        $routes = Route::orderByDesc('id')->paginate($pagination);
        
        if(request()->ajax()){
            if($request->search) {
                $searchQuery = trim($request->query('search'));
                
                $requestData = ['city'];
    
                $routes = Route::where(function($q) use($requestData, $searchQuery) {
                                        foreach ($requestData as $field)
                                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                                })->paginate($pagination);
            }
            
            return view('admin-panel.route.route-table', compact('routes', 'pagination'))->render();
        }

        return view('admin-panel.route.route', compact('routes', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang, Route $route)
    {
        return view('admin-panel.route.route-form', compact('route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteCreateRequest $request)
    {
        $route = new Route;
        
        $route->city = $request->city;
        $route->route_coordinates = $request->route_coordinates;
        
        $route->save();
        
        return redirect()->route('route.index', [ app()->getlocale() ])->with('success-create', 'The resource was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route $route
     * @return \Illuminate\Http\Response
     */
    public function show($lang, Route $route)
    {
        return view('admin-panel.route.route-show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Route $route)
    {
        return view('admin-panel.route.route-form', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update($lang, RouteUpdateRequest $request, Route $route)
    {
        $route->city = $request->city;
        $route->route_coordinates = $request->route_coordinates;
        
        $route->update();

        return redirect()->route('route.index', [ app()->getlocale() ])->with('success-update', 'The resource was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, Route $route)
    {
        $route->delete();
    
        return redirect()->route('route.index', [ app()->getlocale() ])->with('success-delete', 'The resource was deleted!');
    }
}
