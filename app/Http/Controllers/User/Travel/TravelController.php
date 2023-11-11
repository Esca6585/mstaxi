<?php

namespace App\Http\Controllers\User\Travel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Location\Coordinate;
use Location\Distance\Vincenty;
use Location\Formatter\Coordinate\GeoJSON;
use App\Models\Route;
use App\Models\Travel;
use App\Models\Tarif;

class TravelController extends Controller
{
    public function travelStart(Request $request)
    {
        $travel = new Travel();
        
        $travel->user_id = $request->user()->id;
        $travel->tarif_id = $request->tarif_id;
        $travel->lat = $request->lat;
        $travel->lon = $request->lon;
        $travel->price = 0;
        $travel->km = 0;
        $travel->status = 'waiting';
        
        $travel->save();
        
        return response()->json([
            'travel_id' => $travel->id,
        ]);
    }

    public function routeSave(Request $request)
    {
        $travel = Travel::findOrFail($request->travel_id);
        $tarif = Tarif::findOrFail($travel->tarif_id);

        if($travel->status == 'waiting'){
            $metr = $this->waitingMeasureDistance($request->travel_id, $request);

            if($metr > 100){
                $travel->status = 'go';
                $travel->update();

                $this->saveToRouteDB($travel, $request);
    
                return response()->json([
                    'metr' => $metr,
                    'status' => $travel->status,
                    'tarif' => $tarif,
                ]);
            }
        } else if($travel->status == 'go') {
            
            $lastRoute = Route::latest('created_at')->where('travel_id', $travel->id)->where('user_id', $request->user()->id)->first();

            $this->saveToRouteDB($lastRoute, $request); 

            return response()->json([
                'status' => $travel->status,
                'tarif' => $tarif,
                'lastRoute' => $lastRoute,
                '$request->travel_id' => $request->travel_id
            ]);
        }
    }

    public function saveToRouteDB($travel, $request)
    {
        $route = new Route();
        
        $route->travel_id = $request->travel_id;
        $route->user_id = $request->user()->id;
        $route->lat = $request->lat;
        $route->lon = $request->lon;
        $route->price = 0;
        $route->km = $this->measureDistance($travel, $request);
        
        $route->save();
    }

    public function waitingMeasureDistance($travel_id, $route)
    {
        $travel = Travel::findOrFail($travel_id);

        $coordinate1 = new Coordinate($travel->lat, $travel->lon);
        $coordinate2 = new Coordinate($route->lat, $route->lon);
    
        $calculator = new Vincenty();
    
        $metr = $calculator->getDistance($coordinate1, $coordinate2); // returns 128130.850 (meters; ≈128 kilometers)
        $kilometr = $this->metrToKilometr($metr);

        return $metr;
    }

    public function measureDistance($travel, $route)
    {
        $coordinate1 = new Coordinate($travel->lat, $travel->lon);
        $coordinate2 = new Coordinate($route->lat, $route->lon);

        $calculator = new Vincenty();
    
        $metr = $calculator->getDistance($coordinate1, $coordinate2); // returns 128130.850 (meters; ≈128 kilometers)
        $kilometr = $this->metrToKilometr($metr);

        return $metr;
    }

    public function metrToKilometr($metr)
    {
        return $metr*0.001;
    }
}
