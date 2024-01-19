<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'prize_giver_id'];

    public function prizeGiver()
    {
        return $this->belongsTo(User::class, 'prize_giver_id');
    }

    public function lap()
    {
        return $this->belongsTo(Laps::class, 'validated');
    }
}


