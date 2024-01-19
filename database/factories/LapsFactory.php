<?php

namespace Database\Factories;

use App\Models\AllowedLocation;
use App\Models\Laps;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LapsFactory extends Factory
{
    protected $model = Laps::class; // Reference to your Laps model

    public function definition()
    {
        // Factory definition
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'location_id' => AllowedLocation::inRandomOrder()->first()->id,
            'lap_datetime' => $this->faker->dateTimeBetween('-3 year', 'now'),
            'lap_time' => $this->faker->regexify('[0][0-3]:[0-5][0-9]\,[0-9]{2}'),
            'lap_number'=> $this->faker->numberBetween(1, 99),
            'validated'=> $this->faker->boolean(true),
        ];
    }
}
