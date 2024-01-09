<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedLocation extends Model
{

    protected $fillable = ['location'];

    public function laps()
    {
        return $this->hasMany(Laps::class, 'location_id');
    }
}
