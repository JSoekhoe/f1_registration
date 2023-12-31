<?php

namespace App\Http\Controllers;

use App\Models\AllowedLocation;
use App\Models\Laps;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class LapsController extends Controller
{
    public function index(Request $request): View
    {
        // Retrieve laps associated with the authenticated user
        $laps = $request->user()->laps;

        return view('laps.index', [
            'laps' => $laps,
        ]);
    }

    public function create(Request $request): View
    {
        // Retrieve a list of allowed locations from the database
        $allowedLocations = AllowedLocation::all();

        return view('laps.create', [
            'allowedLocations' => $allowedLocations,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'location_id' => 'required|exists:allowed_locations,id',
            'lap_datetime' => 'required|date',
            'lap_time' => 'required|regex:/^\d{2}:\d{2},\d{2}$/',

        ]);

        // Parse lap time
        $lapTime = Carbon::createFromFormat('i:s,u', $request->input('lap_time') . '00');


        // Create the lap
        $lap = $request->user()->laps()->create([
            'location_id' => $request->input('location_id'),
            'lap_datetime' => $request->input('lap_datetime'),
            'lap_time' => $request->input('lap_time'), // Store as MM:SS.u
        ]);

        return redirect()->route('laps.index')->with('success', 'Lap created successfully!');
    }

    public function edit( Laps $lap)
    {
        // Retrieve a list of allowed locations from the database
        $allowedLocations = AllowedLocation::all();

        return view('laps.edit', [
            'lap' => $lap,
            'allowedLocations' => $allowedLocations,
        ]);

    }

    public function update(Request $request, Laps $lap)
    {
        $request->validate([
            'location_id' => 'required|exists:allowed_locations,id',
            'lap_datetime' => 'required|date',
            'lap_time' => 'required|regex:/^\d{2}:\d{2},\d{2}$/',
        ]);
        file_put_contents('C:\Users\soekh\assignmentsJS\f1_registration\app\Http\Controllers\LapsController.txt', $request->input('lap_time')." \n", FILE_APPEND);

        $lap->update([
            'location_id' => $request->input('location_id'),
            'lap_datetime' => $request->input('lap_datetime'),
            'lap_time' => $request->input('lap_time'),
        ]);

        return redirect()->route('laps.index')->with('success', 'Lap updated successfully!');
    }

    public function ajaxValidate(Request $request, Laps $lap)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['error' => 'You do not have permission to validate this lap.'], 403);
        }

        // Update the lap's validation status to true
        $lap->validated = true;
        $lap->save();

        return response()->json(['message' => 'Lap validated successfully.']);
    }

    public function ajaxUnvalidate(Request $request, Laps $lap)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['error' => 'You do not have permission to unvalidate this lap.'], 403);
        }

        // Update the lap's validation status to false
        $lap->validated = false;
        $lap->save();

        return response()->json(['message' => 'Lap unvalidated successfully.']);
    }

    public function destroy(Request $request)
    {
        $lap = $request->user()->laps()->find($request->input('lap_id'));

        if ($lap) {
            $lap->delete();
            return redirect()->route('laps.index')->with('success', 'Lap deleted successfully!');
        } else {
            return redirect()->route('laps.index')->with('error', 'Lap not found.');
        }
    }
}
