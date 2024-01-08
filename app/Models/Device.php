<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'token'];
    protected $table = 'device';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
