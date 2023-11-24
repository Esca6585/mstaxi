<?php

namespace App\Http\Controllers\User\Travel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Location\Coordinate;
use Location\Distance\Vincenty;
use App\Models\Route;
use App\Models\Travel;
use App\Models\Tarif;
use Carbon;
use DateTime;

class TravelController extends Controller
{
    public function tarifs(Request $request)
    {
        $tarifs = Tarif::where('additional_tarif', $request->additional_tarif)->get();

        return response()->json([
            'tarifs' => $tarifs,
        ]);
    }

    public function travelStart(Request $request)
    {
        $tarif = Tarif::findOrFail($request->tarif_id);

        $travel = new Travel();
        
        $travel->user_id = $request->user()->id;
        $travel->tarif_id = $request->tarif_id;
        $travel->lat = $request->lat;
        $travel->lon = $request->lon;
        $travel->price = $tarif->minimum_price;
        $travel->km = 0;
        $travel->status = 'waiting';
        $travel->minimum_price = $tarif->minimum_price;
        $travel->minute_price = $tarif->every_minute_price;
        $travel->km_price += $tarif->every_km_price;
        $travel->waiting_price = $tarif->every_waiting_price;
        $travel->minute_price_outside = $tarif->every_minute_price_outside;
        $travel->km_price_outside = $tarif->every_km_price_outside;
        
        $travel->save();

        $night = $this->dayOrNight();

        return response()->json([
            'status' => $travel->status,
            'night' => $night,
            'tarif' => $tarif,
            'travel' => $travel,
        ]);
    }

    public function travelFinish(Request $request)
    {
        $travel = Travel::findOrFail($request->travel_id);
        $tarif = Tarif::findOrFail($travel->tarif_id);
        
        $lastRoute = Route::latest('created_at')->where('travel_id', $travel->id)->where('user_id', $request->user()->id)->first();

        $this->saveToRouteDBfinish($lastRoute, $request, $tarif);

        $travel->lat_finish = $request->lat_finish;
        $travel->lon_finish = $request->lon_finish;
        $travel->status = 'finished';
        
        $travel->update();

        $night = $this->dayOrNight();

        return response()->json([
            'status' => $travel->status,
            'travel_id' => $travel->id,
            'night' => $night,
            'tarif_id' => $request->tarif_id,
            'tarif' => $tarif,
            'travel' => $travel,
        ]);
    }

    public function routeSave(Request $request)
    {
        $travel = Travel::findOrFail($request->travel_id);
        $tarif = Tarif::findOrFail($travel->tarif_id);

        $night = $this->dayOrNight();

        if($travel->status == 'waiting'){
            $kilometr = $this->waitingMeasureDistance($request->travel_id, $request);

            $diffInMinutes = $this->diffrenceMinute($travel->created_at);

            if($diffInMinutes > 0){
                $travel->price += ($diffInMinutes * $tarif->every_waiting_price);
                $travel->time_of_waiting = $diffInMinutes;
                $travel->minimum_price = $tarif->minimum_price;
                $travel->minute_price = $tarif->every_minute_price;
                $travel->km_price += $tarif->every_km_price;
                $travel->waiting_price = $tarif->every_waiting_price;
                $travel->minute_price_outside = $tarif->every_minute_price_outside;
                $travel->km_price_outside = $tarif->every_km_price_outside;

                $travel->update();
            }

            if($kilometr > 0.1){
                $travel->status = 'go';
                $travel->update();

                $this->saveToRouteDBwaiting($travel, $request, $tarif);
    
                return response()->json([
                    'status' => $travel->status,
                    'kilometr' => $kilometr,
                    'night' => $night,
                    'tarif' => $tarif,
                    'travel' => $travel,
                ]);
            } else {
                return response()->json([
                    'status' => $travel->status,
                    'kilometr' => $kilometr,
                    'night' => $night,
                    'tarif' => $tarif,
                    'travel' => $travel,
                ]);
            }
        } else if($travel->status == 'go') {
            
            $lastRoute = Route::latest('created_at')->where('travel_id', $travel->id)->where('user_id', $request->user()->id)->first();

            $this->saveToRouteDBgo($lastRoute, $request, $tarif);

            $kilometr = $this->waitingMeasureDistance($request->travel_id, $request);

            return response()->json([
                'status' => $travel->status,
                'kilometr' => $kilometr,
                'lastRoute' => $lastRoute,
                'night' => $night,
                'tarif' => $tarif,
                'travel' => $travel
            ]);
        }
    }

    public function saveToRouteDBwaiting($travel, $request, $tarif)
    {
        $travel = Travel::findOrFail($request->travel_id);
        $tarif = Tarif::findOrFail($travel->tarif_id);
        
        $km = $this->measureDistance($travel, $request);

        $route = new Route();
        
        $route->travel_id = $request->travel_id;
        $route->user_id = $request->user()->id;
        $route->lat = $request->lat;
        $route->lon = $request->lon;
        $route->km = $km;
        $route->price = ($km*$tarif->every_km_price);
        
        $route->save();
        
        $diffInMinutes = $this->diffrenceMinute($travel->created_at);

        $travel->km += $km;
        $travel->price += ($km*$tarif->every_km_price);
        $travel->minimum_price = $tarif->minimum_price;
        $travel->minute_price = ($diffInMinutes * $tarif->every_minute_price);
        $travel->km_price += ($km*$tarif->every_km_price);
        $travel->waiting_price = ($diffInMinutes * $tarif->every_waiting_price);
        $travel->minute_price_outside = $tarif->every_minute_price_outside;
        $travel->km_price_outside = $tarif->every_km_price_outside;
        
        $travel->update();
    }

    public function saveToRouteDBgo($lastRoute, $request, $tarif)
    {   
        $travel = Travel::findOrFail($request->travel_id);
        
        $km = $this->measureDistance($lastRoute, $request);

        $route = new Route();
        
        $route->travel_id = $request->travel_id;
        $route->user_id = $request->user()->id;
        $route->lat = $request->lat;
        $route->lon = $request->lon;
        $route->km = $km;
        $route->price = ($km*$tarif->every_km_price);
        
        $route->save();
        
        $diffInMinutes = $this->diffrenceMinute($lastRoute->created_at);

        $travel->km += $km;
        $travel->price += ($km*$tarif->every_km_price);
        $travel->minimum_price = $tarif->minimum_price;
        $travel->minute_price = ($diffInMinutes * $tarif->every_minute_price);
        $travel->km_price += ($km*$tarif->every_km_price);
        $travel->waiting_price = ($diffInMinutes * $tarif->every_waiting_price);
        $travel->minute_price_outside = $tarif->every_minute_price_outside;
        $travel->km_price_outside = $tarif->every_km_price_outside;
        
        $travel->update();
    }

    public function saveToRouteDBfinish($travel, $request, $tarif)
    {
        $travel = Travel::findOrFail($request->travel_id);
        $tarif = Tarif::findOrFail($travel->tarif_id);
        
        $km = $this->measureDistanceFinish($travel, $request);

        $route = new Route();
        
        $route->travel_id = $request->travel_id;
        $route->user_id = $request->user()->id;
        $route->lat = $request->lat_finish;
        $route->lon = $request->lon_finish;
        $route->km = $km;
        $route->price = ($km*$tarif->every_km_price);
        
        $route->save();
        
        $diffInMinutes = $this->diffrenceMinute($travel->created_at);

        $travel->km += $km;
        $travel->price += ($km*$tarif->every_km_price);
        $travel->minimum_price = $tarif->minimum_price;
        $travel->minute_price = ($diffInMinutes * $tarif->every_minute_price);
        $travel->km_price += ($km*$tarif->every_km_price);
        $travel->waiting_price = ($diffInMinutes * $tarif->every_waiting_price);
        $travel->minute_price_outside = $tarif->every_minute_price_outside;
        $travel->km_price_outside = $tarif->every_km_price_outside;
        
        $travel->update();
    }

    public function diffrenceMinute($created_at)
    {
        $now = Carbon::now()->toDateTimeString();

        $date1 = new DateTime($now);
        $date2 = new DateTime($created_at);

        $difference = $date1->diff($date2);
        $diffInMinutes = $difference->i - 2;

        if($diffInMinutes > 0) return $diffInMinutes;
        else return 0;
    }
    
    public function waitingMeasureDistance($travel_id, $route)
    {
        $travel = Travel::findOrFail($travel_id);

        $coordinate1 = new Coordinate($travel->lat, $travel->lon);
        $coordinate2 = new Coordinate($route->lat, $route->lon);
    
        $calculator = new Vincenty();
    
        $metr = $calculator->getDistance($coordinate1, $coordinate2);
        $kilometr = $this->metrToKilometr($metr);

        return $kilometr;
    }

    public function measureDistance($travel, $route)
    {
        $coordinate1 = new Coordinate($travel->lat, $travel->lon);
        $coordinate2 = new Coordinate($route->lat, $route->lon);

        $calculator = new Vincenty();
    
        $metr = $calculator->getDistance($coordinate1, $coordinate2);
        $kilometr = $this->metrToKilometr($metr);

        return $kilometr;
    }
    
    public function measureDistanceFinish($travel, $route)
    {
        $coordinate1 = new Coordinate($travel->lat, $travel->lon);
        $coordinate2 = new Coordinate($route->lat_finish, $route->lon_finish);

        $calculator = new Vincenty();
    
        $metr = $calculator->getDistance($coordinate1, $coordinate2);
        $kilometr = $this->metrToKilometr($metr);

        return $kilometr;
    }

    public function measureTwoDistance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat1' => 'required',
            'lon1' => 'required',
            'lat2' => 'required',
            'lon2' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $coordinate1 = new Coordinate($request->lat1, $request->lon1);
        $coordinate2 = new Coordinate($request->lat2, $request->lon2);

        $calculator = new Vincenty();
    
        $metr = $calculator->getDistance($coordinate1, $coordinate2);
        $kilometr = $this->metrToKilometr($metr);

        return $kilometr;
    }

    public function metrToKilometr($metr)
    {
        return $metr*0.001;
    }

    public function dayOrNight()
    {
        $time = Carbon::now()->format('H');

        if($time > 6 && $time < 21){
            return 'Day';
        } else {
            return 'Night';
        }
    }
}
