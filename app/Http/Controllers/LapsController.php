<?php

namespace App\Http\Controllers;


use App\Models\AllowedLocation;
use App\Models\Laps;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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
        // Validate the form data
        $request->validate([
            'location_id' => 'required|exists:allowed_locations,id',
            'lap_datetime' => 'required|date',
        ]);

        // Create a new Lap model and associate it with the authenticated user
        $lap = auth()->user()->laps()->create([
            'location_id' => $request->input('location_id'),
            'lap_datetime' => $request->input('lap_datetime'),
        ]);

        return redirect()->route('laps.index')->with('success', 'Lap created successfully!');
    }



    public function edit(Laps $lap)
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
        // Validate the form data
        $request->validate([
            'location_id' => 'required|exists:allowed_locations,id',
            'lap_datetime' => 'required|date',
        ]);

        // Update the Lap model with the new data
        $lap->update([
            'location_id' => $request->input('location_id'),
            'lap_datetime' => $request->input('lap_datetime'),
        ]);

        return redirect()->route('laps.index')->with('success', 'Lap updated successfully!');
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
