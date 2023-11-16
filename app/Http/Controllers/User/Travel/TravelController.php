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
use Carbon;
use DateTime;

class TravelController extends Controller
{
    public function travelStart(Request $request)
    {
        $tarif = Tarif::findOrFail($request->tarif_id);

        $travel = new Travel();
        
        $travel->user_id = $request->user()->id;
        $travel->tarif_id = $request->tarif_id;
        $travel->lat = $request->lat;
        $travel->lon = $request->lon;
        $travel->price = 0;
        $travel->km = 0;
        $travel->status = 'waiting';
        
        $travel->save();

        $time = Carbon::now()->format('H');

        if($time >= 6 && $time <= 22){
            $night = 'Day';
        } else {
            $night = 'Night';
        }

        return response()->json([
            'travel_id' => $travel->id,
            'night' => $night,
            'tarif_id' => $request->tarif_id,
            'tarif' => $tarif,
            'travel' => $travel,
            'status' => $travel->status,
        ]);
    }

    public function routeSave(Request $request)
    {
        return $request->all();
        
        $travel = Travel::findOrFail($request->travel_id);
        $tarif = Tarif::findOrFail($travel->tarif_id);

        $time = Carbon::now()->format('H');

        if($time >= 6 && $time <= 22){
            $night = 'Day';
        } else {
            $night = 'Night';
        }

        if($travel->status == 'waiting'){
            $metr = $this->waitingMeasureDistance($request->travel_id, $request);
            
            $now = Carbon::now()->toDateTimeString();
            
            $date1 = new DateTime($now);
            $date2 = new DateTime($travel->created_at);

            $difference = $date1->diff($date2);
            $diffInMinutes = $difference->i;

            if($diffInMinutes >= 2){
                $diffInMinutes -= 2;
                $wait_price = $diffInMinutes * $tarif->every_waiting_price;

                $travel->price = $travel->price + $wait_price;
                $travel->update();
            }

            if($metr > 0.1){
                $travel->status = 'go';
                $travel->update();

                $this->saveToRouteDB($travel, $request, $tarif);
    
                return response()->json([
                    'metr' => $metr,
                    'travel_id' => $request->travel_id,
                    'night' => $night,
                    'tarif_id' => $request->tarif_id,
                    'tarif' => $tarif,
                    'travel' => $travel,
                    'status' => $travel->status,
                    'diffInMinutes' => $diffInMinutes,
                ]);
            } else {
                return response()->json([
                    'metr' => $metr,
                    'travel_id' => $request->travel_id,
                    'night' => $night,
                    'tarif_id' => $request->tarif_id,
                    'tarif' => $tarif,
                    'travel' => $travel,
                    'status' => $travel->status,
                    'diffInMinutes' => $diffInMinutes,
                ]);
            }
        } else if($travel->status == 'go') {
            
            $lastRoute = Route::latest('created_at')->where('travel_id', $travel->id)->where('user_id', $request->user()->id)->first();

            $this->saveToRouteDB($lastRoute, $request, $tarif);

            return response()->json([
                'lastRoute' => $lastRoute,
                'travel_id' => $request->travel_id,
                'night' => $night,
                'tarif_id' => $request->tarif_id,
                'tarif' => $tarif,
                'travel' => $travel,
                'status' => $travel->status,
            ]);
        }
    }

    public function saveToRouteDB($travel, $request, $tarif)
    {
        $travel = Travel::findOrFail($request->travel_id);
        $tarif = Tarif::findOrFail($travel->tarif_id);

        $route = new Route();
        
        $route->travel_id = $request->travel_id;
        $route->user_id = $request->user()->id;
        $route->lat = $request->lat;
        $route->lon = $request->lon;
        $route->km = $this->measureDistance($travel, $request);
        $route->price += ($route->km*$tarif->every_km_price);
        
        $route->save();
        
        $travel->km += $route->km;
        $travel->price += ($travel->km*$tarif->every_km_price);
        
        $travel->update();
    }

    public function waitingMeasureDistance($travel_id, $route)
    {
        $travel = Travel::findOrFail($travel_id);

        $coordinate1 = new Coordinate($travel->lat, $travel->lon);
        $coordinate2 = new Coordinate($route->lat, $route->lon);
    
        $calculator = new Vincenty();
    
        $metr = $calculator->getDistance($coordinate1, $coordinate2); // returns 128130.850 (meters; ≈128 kilometers)
        $kilometr = $this->metrToKilometr($metr);

        return $kilometr;
    }

    public function measureDistance($travel, $route)
    {
        $coordinate1 = new Coordinate($travel->lat, $travel->lon);
        $coordinate2 = new Coordinate($route->lat, $route->lon);

        $calculator = new Vincenty();
    
        $metr = $calculator->getDistance($coordinate1, $coordinate2); // returns 128130.850 (meters; ≈128 kilometers)
        $kilometr = $this->metrToKilometr($metr);

        return $kilometr;
    }

    public function metrToKilometr($metr)
    {
        return $metr*0.001;
    }
}
