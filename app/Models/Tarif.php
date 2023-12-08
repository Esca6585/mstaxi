<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $table = 'tarifs';

    protected $fillable = [
        'name_tm',
        'name_ru',
        'minimum_price',
        'every_minute_price',
        'every_km_price',
        'every_waiting_price',
        'free_waiting_minute',
        'every_minute_price_outside',
        'every_km_price_outside',
        'additional_tarif',
        'image',
    ];
}
