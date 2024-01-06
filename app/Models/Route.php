<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'routes';

    protected $fillable = [
        'travel_id',
        'user_id',
        'price',
        'km',
        'lat',
        'lon',
    ];

    public function toSearchableArray()
    {
        return [
            'price' => '',
            'km' => '',
            'lat' => '',
            'lon' => '',
            'travel.price' => '',
            'travel.km' => '',
            'travel.lat' => '',
            'travel.lon' => '',
            'travel.lat_finish' => '',
            'travel.lon_finish' => '',
            'travel.time_of_waiting' => '',
            'travel.status' => '',
            'user.first_name' => '',
            'user.last_name' => '',
            'user.car_number' => '',
            'user.car_model' => '',
            'user.birthday' => '',
            'user.start_working' => '',
            'user.username' => '',
            'user.password' => '',
            'user.status' => '',
        ];
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
