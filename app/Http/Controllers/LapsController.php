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
        // Retrieve a list of laps from the database
        $laps = Laps::all();


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
            'lap_id' => 'required',
            'location_id' => 'required|exists:allowed_locations,id',
            'lap_datetime' => 'required|date',
        ]);

        // Create a new Lap model and save it to the database
        Laps::create([
            'lap_id' => $request->input('lap_id'),
            'location_id' => $request->input('location_id'),
            'lap_datetime' => $request->input('lap_datetime'),
        ]);

        return redirect()->route('laps.index')->with('success', 'Lap created successfully!');
    }

    public function edit(Request $request): View
    {
        // Implement edit logic
        // You can retrieve the lap to be edited and pass it to the view
        // For example: $lap = Lap::find($request->input('lap_id'));
        // Then, pass $lap to the view
    }

    public function update(Request $request): View
    {
        // Implement update logic
        // You can update the lap based on the form data
    }

    public function destroy(Request $request): RedirectResponse
    {
        $lap = Laps::find($request->input('lap_id'));

        if ($lap) {
            $lap->delete();
            return redirect()->route('laps.index')->with('success', 'Lap deleted successfully!');
        } else {
            return redirect()->route('laps.index')->with('error', 'Lap not found.');
        }
    }
}
