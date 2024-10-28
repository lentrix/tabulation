<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Competition;
use Inertia\Inertia;

class GuestController extends Controller
{
    public function index() {
        if(auth()->user()) return redirect('/dashboard');

        $activeEvent = Event::where('start','<=', now())
                ->where('end','>',now())->first();

        $competitions = Competition::where('event_id', $activeEvent?->id)->orderBy('name');

        $rowsPerPage = 7;

        $pages = ceil($competitions->count() / $rowsPerPage);

        return Inertia::render('Welcome',[
            'activeEvent' => $activeEvent,
            'teams' => $activeEvent?->teams->map(function($data){
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'description' => $data->description,
                    'totalPoints' => $data->totalPoints
                ];
            }),
            'comps' => $competitions->paginate($rowsPerPage)->map(function($data){
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'teams' => $data->teamResults
                ];
            }),
            'pages' => $pages,
            'summary' => $activeEvent?$activeEvent->medalSummary():[]
        ]);
    }
}
