<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laps extends Model
{
    use HasFactory;
    protected $fillable = [
        'lap_id',
        'location_id',
        'lap_datetime',

    ];

    public function allowedLocation()
    {
        return $this->belongsTo(AllowedLocation::class, 'location_id');
    }
}
