<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travels';

    protected $fillable = [
        'user_id',
        'tarif_id',
        'price',
        'km',
        'lat',
        'lon',
        'lat_finish',
        'lon_finish',
        'time_of_waiting',
        'time_of_full',
        'minimum_price',
        'minute_price',
        'km_price',
        'waiting_price',
        'minute_price_outside',
        'km_price_outside',
        'status',
    ];

    public function toSearchableArray()
    {
        return [
            'price' => '',
            'km' => '',
            'lat' => '',
            'lon' => '',
            'lat_finish' => '',
            'lon_finish' => '',
            'time_of_waiting' => '',
            'status' => '',
            'user.first_name' => '',
            'user.last_name' => '',
            'user.car_number' => '',
            'user.car_model' => '',
            'user.birthday' => '',
            'user.start_working' => '',
            'user.username' => '',
            'user.password' => '',
            'user.status' => '',
            'tarif.name_tm' => '',
            'tarif.name_ru' => '',
            'tarif.minimum_price' => '',
            'tarif.every_minute_price' => '',
            'tarif.every_km_price' => '',
            'tarif.every_waiting_price' => '',
            'tarif.every_minute_price_outside' => '',
            'tarif.every_km_price_outside' => '',
            'tarif.additional_tarif' => '',
            'tarif.image' => '',
            'route.price' => '',
            'route.km' => '',
            'route.lat' => '',
            'route.lon' => '',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
