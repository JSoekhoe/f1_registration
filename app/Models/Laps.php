<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laps extends Model
{
    use HasFactory;

    protected $primaryKey = 'lap_id'; // Add this line

    protected $fillable = [
        'user_id',
        'location_id',
        'lap_datetime',
    ];

    protected $dates = [
        'lap_datetime',
    ];

    public function allowedLocation()
    {
        return $this->belongsTo(AllowedLocation::class, 'location_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'lap_id';
    }
}
