<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Place;
use App\Models\Placer;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'label' => 'string|required',
            'emblem' => 'string|required',
            'default_weight' => 'numeric|required'
        ]);

        Place::create($request->all());

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Created a place labeled: ' . $request->label
        ]);

        return back()->with('Info','A new winning place has been added.');
    }

    public function update(Request $request, Place $place) {
        $request->validate([
            'label' => 'string|required',
            'emblem' => 'string|required',
            'default_weight' => 'numeric|required'
        ]);

        $place->update($request->all());

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Updated a place labeled: ' . $request->label
        ]);

        return back()->with('Info','The winning place has been updated.');
    }

    public function destroy(Place $place) {
        $label = $place->label;
        $place->delete();

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Deleted a place labeled: ' . $label
        ]);

        return back()->with('Info','A place has been deleted.');
    }

    public function setPlacer(Request $request) {
        $placer = Placer::where('team_id', $request->team_id)
                ->where('competition_id', $request->competition_id)->first();

        $logText='';

        if($placer) {
            if($request->place_id) {
                $placer->place_id=$request->place_id;
                $placer->custom_weight = $request->custom_weight;
                $placer->save();
                $logText = 'Update place ' . $placer->place->label . ' to ' . $placer->team->name . ' on ' . $placer->competition->name;
            }else {
                $logText = 'Remove place ' . $placer->place->label . ' from ' . $placer->team->name . ' on ' . $placer->competition->name;
                $placer->delete();
            }
        }else {
            if($request->place_id)
                $p = Placer::create($request->all());

            $logText = 'Set place ' . $p->place->label . ' to ' . $p->team->name . ' on ' . $p->competition->name;
        }

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => $logText
        ]);

        return back()->with('Info','A placer has been set.');
    }
}
