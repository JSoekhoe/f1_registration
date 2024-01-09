<?php

namespace App\Http\Controllers;

    use App\Models\AllowedLocation;
    use App\Models\Laps;
    use Illuminate\Http\Request;
    use App\Models\Leaderboard;
    use Illuminate\Support\Facades\DB;

    class LeaderboardController extends Controller
    {
        public function index()
        {
            $locations = AllowedLocation::all();
            $leaderboardData = [];

            foreach ($locations as $location) {
                $leaderboardData[] = [
                    'location' => $location,
                    'laps' => Laps::where('location_id', $location->id)
                        ->where('validated', true) // Filter by validated laps
                        ->orderBy('lap_time', 'asc')
                        ->take(5)
                        ->get()
                ];
            }
            return view('leaderboard.index', ['leaderboardData' => $leaderboardData]);
        }
    }

