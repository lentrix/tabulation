<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
        ]);

        Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'event_id' => $request->event_id,
        ]);

        return back()->with('Info','A new team has been created.');
    }

    public function update(Team $team, Request $request) {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
        ]);

        $team->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return back()->with('Info','The team has been updated.');
    }

    public function destroy(Team $team)
    {
        $name = $team->name;
        $team->delete();
        return back()->with('Info','The team ' . $name . ' has been deleted.');
    }
}
