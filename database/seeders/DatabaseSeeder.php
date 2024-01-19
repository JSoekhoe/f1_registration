<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AllowedLocation;
use App\Models\Laps;
use App\Models\Prize;
use App\Models\User;
use Database\Factories\LapsFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the allowed locations
        $locations = [
            'Albert Park Circuit - Australia',
            'Autódromo Hermanos Rodríguez - Mexico',
            'Autodromo Internazionale Enzo e Dino Ferrari - Italy',
            'Autodromo José Carlos Pace - Brazil',
            'Bahrain International Circuit - Bahrain',
            'Baku City Circuit - Azerbaijan',
            'Circuit de Barcelona-Catalunya - Spain',
            'Circuit de Monaco - Monaco',
            'Circuit de Spa-Francorchamps - Belgium',
            'Circuit Gilles-Villeneuve - Canada',
            'Circuit of the Americas - United States',
            'Circuit Zandvoort - The Netherlands',
            'Hungaroring - Hungary',
            'Jeddah Corniche Circuit - Saudi Arabia',
            'Las Vegas Strip Circuit - United States',
            'Lusail International Circuit - Qatar',
            'Marina Bay Street Circuit - Singapore',
            'Miami International Autodrome - United States',
            'Red Bull Ring - Austria',
            'Silverstone Circuit - United Kingdom',
            'Suzuka International Racing Course - Japan',
            'Yas Marina Circuit - United Arab Emirates',
        ];

        foreach ($locations as $location) {
            AllowedLocation::create(['location' => $location]);
        }


        $users = [
            [
                'firstname' => 'admin',
                'lastname' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'is_admin' => true,
                'password' => bcrypt('admin'), // Use bcrypt() instead of Hash::make()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $prizes = [
            ['title' => 'first race', 'description' => 'get your first race validated','location' => $location],
            ['title' => 'second race', 'description' => 'get your second race validated'],
            ['title' => 'speed demon', 'description' => 'have the fastest validated lap on the Autódromo Hermanos Rodríguez - Mexico'],
            // ... add more prize descriptions
        ];

        foreach ($prizes as $prizeData) {
            $prize = Prize::create(['title' => $prizeData['title'], 'description' => $prizeData['description']]);
            $prize->save();
        }

        User::factory()
            ->count(10)
            ->create();

        Laps::factory()
            ->count(1000)
            ->create();
    }
}





