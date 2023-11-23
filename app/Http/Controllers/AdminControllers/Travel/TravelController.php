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
                
                $requestData = ['price', 'km', 'lat', 'lon', 'lat_finish', 'lon_finish', 'time_of_waiting', 'status',];
    
                $travels = Travel::where(function($query) use ($searchQuery){
                        $query->where('price', 'like', "%$searchQuery%")
                        ->orWhere('km', 'like', "%$searchQuery%")
                        ->orWhere('lat', 'like', "%$searchQuery%")
                        ->orWhere('lon', 'like', "%$searchQuery%");
                    })
                    ->orWhereHas('user', function($query) use($searchQuery){
                        $query->where('first_name', 'like', "%$searchQuery%");
                        $query->where('last_name', 'like', "%$searchQuery%");
                        $query->where('car_number', 'like', "%$searchQuery%");
                        $query->where('car_model', 'like', "%$searchQuery%");
                        $query->where('birthday', 'like', "%$searchQuery%");
                        $query->where('start_working', 'like', "%$searchQuery%");
                        $query->where('birthday', 'like', "%$searchQuery%");
                        $query->where('status', 'like', "%$searchQuery%");
                    })
                    ->orWhereHas('tarif', function($query) use($searchQuery){
                        $query->where('name_tm', 'like', "%$searchQuery%");
                        $query->where('name_ru', 'like', "%$searchQuery%");
                        $query->where('minimum_price', 'like', "%$searchQuery%");
                        $query->where('every_minute_price', 'like', "%$searchQuery%");
                        $query->where('every_km_price', 'like', "%$searchQuery%");
                        $query->where('every_waiting_price', 'like', "%$searchQuery%");
                        $query->where('every_minute_price_outside', 'like', "%$searchQuery%");
                        $query->where('every_km_price_outside', 'like', "%$searchQuery%");
                        $query->where('additional_tarif', 'like', "%$searchQuery%");
                        $query->where('image', 'like', "%$searchQuery%");
                    })
                    ->paginate($pagination);
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
