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
        $tarifs = Tarif::where('additional_tarif', 1)->get();

        return response()->json([
            'tarifs' => $tarifs,
        ]);
    }

    public function travelStart(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'tarif_id' => 'required',
            'lat' => 'required',
            'lon' => 'required',
        ]);

        $tarif = Tarif::findOrFail($request->tarif_id);

        $travel = new Travel();
        
        $travel->user_id = $request->user()->id;
        $travel->tarif_id = $request->tarif_id;
        $travel->lat = $request->lat;
        $travel->lon = $request->lon;
        $travel->price = $tarif->minimum_price;
        $travel->km = 0;
        $travel->status = 'waiting';
        
        $travel->save();

        $night = $this->dayOrNight();

        return response()->json([
            'travel_id' => $travel->id,
            'night' => $night,
            'tarif_id' => $request->tarif_id,
            'tarif' => $tarif,
            'travel' => $travel,
            'status' => $travel->status,
        ]);
    }

    public function travelFinish(Request $request)
    {
        $travel = Travel::findOrFail($request->travel_id);
        $tarif = Tarif::findOrFail($travel->tarif_id);
        
        $travel->lat_finish = $request->lat_finish;
        $travel->lon_finish = $request->lon_finish;
        $travel->time_of_waiting = $request->time_of_waiting;
        $travel->status = 'finished';
        
        $travel->update();

        $night = $this->dayOrNight();

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
        $travel = Travel::findOrFail($request->travel_id);
        $tarif = Tarif::findOrFail($travel->tarif_id);

        $night = $this->dayOrNight();

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
                $travel->time_of_waiting = $diffInMinutes;

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
        $travel->price += ($travel->km*$tarif->every_km_price);
        
        $travel->update();
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
