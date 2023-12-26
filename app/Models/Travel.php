<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travels';

    protected $casts = [
        'tarifs' => 'array',
    ];

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
        'tarifs',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class);
    }

    public function additional_tarifs($ids)
    {
        $additional_tarifs = Tarif::whereIn('id', $ids)->get();

        return $additional_tarifs;
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
