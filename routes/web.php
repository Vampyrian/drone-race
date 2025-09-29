<?php

use App\Http\Controllers\Dashboard\RaceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('dashboard/races', [RaceController::class, 'index'])->name('race.index');
    Route::get('dashboard/races/create', [RaceController::class, 'create'])->name('race.create');
    Route::post('dashboard/races', [RaceController::class, 'store'])->name('race.store');
    Route::get('dashboard/races/{race}/edit', [RaceController::class, 'edit'])->name('race.edit');
    Route::put('dashboard/races/{race}/', [RaceController::class, 'update'])->name('race.update');
    Route::delete('dashboard/races/{race}/', [RaceController::class, 'destroy'])->name('race.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
