<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RaceRequest;
use App\Models\Race;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class RaceController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('dashboard/race/Index', [
            'races' => Race::all()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('dashboard/race/Create');
    }

    public function store(RaceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Race::create([
            'slug' => Str::slug($data['name']),
            ...$data
        ]);

        return to_route('race.index')->with('status', 'Race created successfully.');
    }

    public function edit(Race $race): Response
    {
        return Inertia::render('dashboard/race/Update', [
            'raceToUpdate' => $race
        ]);
    }

    public function update(Race $race, RaceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $race->update([
            'slug' => Str::slug($data['name']),
            ...$data
        ]);

        return to_route('race.index')->with('status', 'Race updated successfully.');
    }

    public function destroy(Race $race): RedirectResponse
    {
        $race->delete();
        return to_route('race.index')->with('status', 'Race deleted successfully.');
    }
}
