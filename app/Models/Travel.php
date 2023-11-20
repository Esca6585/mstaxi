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

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
