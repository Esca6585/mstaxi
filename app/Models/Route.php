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
        'city',
        'area',
        'lat',
        'lon',
    ];
}
