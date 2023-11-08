<?php

namespace App\Http\Controllers\AdminControllers\Travel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Requests\TravelCreateRequest;
use App\Http\Requests\TravelUpdateRequest;
use Image;
use Str;
use Hash;

class TravelController extends Controller
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

        $travels = Travel::orderByDesc('id')->paginate($pagination);
        
        if(request()->ajax()){
            if($request->search) {
                $searchQuery = trim($request->query('search'));
                
                $requestData = ['driver_id', 'route_id', 'price', 'km'];
    
                $travels = Travel::where(function($q) use($requestData, $searchQuery) {
                                        foreach ($requestData as $field)
                                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                                })->paginate($pagination);
            }
            
            return view('admin-panel.travel.travel-table', compact('travels', 'pagination'))->render();
        }

        return view('admin-panel.travel.travel', compact('travels', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang, Travel $travel)
    {
        return view('admin-panel.travel.travel-form', compact('travel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelCreateRequest $request)
    {
        $travel = new Travel;
        
        $travel->driver_id = $request->driver_id;
        $travel->route_id = $request->route_id;
        $travel->price = $request->price;
        $travel->km = $request->km;
        
        $travel->save();
        
        return redirect()->route('travel.index', [ app()->getlocale() ])->with('success-create', 'The resource was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel $travel
     * @return \Illuminate\Http\Response
     */
    public function show($lang, Travel $travel)
    {
        return view('admin-panel.travel.travel-show', compact('travel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Travel $travel)
    {
        return view('admin-panel.travel.travel-form', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update($lang, TravelUpdateRequest $request, Travel $travel)
    {
        $travel->driver_id = $request->driver_id;
        $travel->route_id = $request->route_id;
        $travel->price = $request->price;
        $travel->km = $request->km;
        
        $travel->update();

        return redirect()->route('travel.index', [ app()->getlocale() ])->with('success-update', 'The resource was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, Travel $travel)
    {
        $travel->delete();
    
        return redirect()->route('travel.index', [ app()->getlocale() ])->with('success-delete', 'The resource was deleted!');
    }
}
