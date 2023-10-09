<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        $events = Event::orderBy('start','desc')->get();
        return inertia('Events/Index',[
            'events' => $events
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'string|required',
            'description' => 'string|required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start_date . " " . $request->start_time,
            'end' => $request->end_date . " " . $request->end_time,
        ]);

        return redirect('/events')->with('Info','A new event has been created.');
    }

    public function show(Event $event) {
        return inertia('Events/Show',[
            'event' => $event
        ]);
    }
}
