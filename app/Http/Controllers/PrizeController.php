<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prize;

class PrizeController extends Controller
{
    public function index()
    {
        $prizes = Prize::with('lap')->get();
        return view('prizes.index', compact('prizes'));
    }

    public function create()
    {
        return view('prizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // Assuming you want to associate the prize with the authenticated user
        $prize = auth()->user()->prizes()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('prizes.index')->with('success', 'Prijs succesvol toegevoegd');
    }

    public function show(Prize $prize)
    {
        // You can implement the logic for displaying a specific prize if needed
    }

    public function edit(Prize $prize)
    {
        $lap = $prize->lap;

        return view('prizes.edit', [
            'lap' => $lap,
            'prize' => $prize,
        ]);
    }

    public function update(Request $request, Prize $prize)
    {
        // Implement the logic for updating a prize if needed
    }

    public function destroy(Prize $prize)
    {
        // Implement the logic for deleting a prize if needed
    }
}
