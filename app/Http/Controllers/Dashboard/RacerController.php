<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RacerRequest;
use App\Models\Race;
use App\Models\Racer;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class RacerController extends Controller
{
    public function index(Race $race): Response
    {
        return Inertia::render('dashboard/racer/Index', [
            'racers' => Racer::all(),
            'race' => $race,
        ]);
    }

    public function create(Race $race): Response
    {
        return Inertia::render('dashboard/racer/Create', [
            'race' => $race,
        ]);
    }

    public function store(RacerRequest $request, Race $race): RedirectResponse
    {
        Racer::create([
            ...$request->validated(),
            'race_id' => $race->id,
        ]);

        return to_route('racer.index', [$race->id])->with('status', 'Racer created successfully.');
    }

    public function edit(Race $race, Racer $racer): Response
    {
        return Inertia::render('dashboard/racer/Update', [
            'race' => $race,
            'racer' => $racer
        ]);
    }

    public function update(Race $race, Racer $racer, RacerRequest $request): RedirectResponse
    {
        $racer->update($request->validated());
        return to_route('racer.index', [$race->id])->with('status', 'Racer updated successfully.');
    }

    public function destroy(Race $race, Racer $racer): RedirectResponse
    {
        $racer->delete();
        return to_route('racer.index', [$race->id])->with('status', 'Racer deleted successfully.');
    }
}
