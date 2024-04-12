<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prize;
use App\Models\User;

class PrizeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userPrizes = $user->prizes()->pluck('prize_id')->toArray();

        // Alle beschikbare prijzen uit de database halen
        $prizes = Prize::all();

        // Voor elke prijs controleren of de gebruiker deze heeft behaald
        foreach ($prizes as $prize) {
            $prize->achieved = in_array($prize->id, $userPrizes);
        }

        // Check voor nieuwe prijzen die de gebruiker mogelijk heeft verdiend
        $this->checkAchievements($user);

        return view('prizes.index', compact('prizes', 'userPrizes'));
    }



    private function checkAchievements(User $user)
    {
        // Get all available prizes
        $availablePrizes = Prize::all();

        // Loop through all prizes and check if the user meets the requirements
        foreach ($availablePrizes as $prize) {
            // If the user meets the requirements and hasn't earned the prize yet, attach it to the user
            if ($this->userMeetsRequirementsForPrize($user, $prize) && !$user->prizes()->where('title', $prize->title)->exists()) {
                $this->attachPrizeToUser($user, $prize->title);
            }
        }
    }

    private function userMeetsRequirementsForPrize(User $user, Prize $prize)
    {
        // Implement logic to check requirements for each prize
        switch ($prize->title) {
            case 'First Lap':
                return $user->laps()->where('validated', true)->exists();
            case 'Second Lap':
                return $user->laps()->where('validated', true)->count() >= 2;
            case 'Record Breaker':
                // Implement logic for Record Breaker prize
                break;
            case 'Furious Challenger':
                // Implement logic for Furious Challenger prize
                break;
            // Add cases for other prizes and implement logic for each case
            default:
                return false;
        }
    }

    private function attachPrizeToUser(User $user, $prizeTitle)
    {
        $prize = Prize::where('title', $prizeTitle)->first();
        if ($prize) {
            $user->prizes()->attach($prize->prize_id); // Change 'id' to 'prize_id'
        }
    }
}
