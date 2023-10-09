<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/dashboard', function () {
    $events = Event::orderBy('id','desc')->get();

    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/events/{event}/create-team', [EventController::class, 'createTeam']);
    Route::get('/events/{event}',[EventController::class, 'show']);
    Route::get('/events',[EventController::class, 'index'])->name('events');
    Route::post('/events',[EventController::class, 'store']);

    Route::post('/teams', [TeamController::class, 'store']);
    Route::patch('/teams/{team}',[TeamController::class, 'update']);
    Route::delete('/teams/{team}',[TeamController::class, 'destroy']);

    Route::post('/places',[PlaceController::class, 'store']);
    Route::patch('/places/{place}',[PlaceController::class, 'update']);
    Route::delete('/places/{place}',[PlaceController::class, 'destroy']);

    Route::post('/competitions',[CompetitionController::class, 'store']);
    Route::patch('/competitions/{competition}',[CompetitionController::class, 'update']);
    Route::delete('/competitions/{competition}',[CompetitionController::class, 'destroy']);

});

require __DIR__.'/auth.php';
