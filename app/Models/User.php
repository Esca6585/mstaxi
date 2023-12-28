<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Travel;
use DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'car_number',
        'car_model',
        'birthday',
        'start_working',
        'username',
        'password',
        'status',
        'online',
        'device_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function travels()
    {
        return $this->hasMany(Travel::class);
    }

    public function all_km()
    {
        $query = Travel::select(DB::raw("SUM(km) as all_km"))
                    ->groupBy('km')
                    ->get();
                    
        return $query;
    }

    public function all_price()
    {
        $query = Travel::select(DB::raw("SUM(price) as all_price"))
                    ->groupBy('price')
                    ->get();
                    
        return $query;
    }
}
