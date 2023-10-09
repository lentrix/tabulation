<?php

namespace App\Http\Controllers;

use App\Models\Place;
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

        return back()->with('Info','A new winning place has been added.');
    }

    public function update(Request $request, Place $place) {
        $request->validate([
            'label' => 'string|required',
            'emblem' => 'string|required',
            'default_weight' => 'numeric|required'
        ]);

        $place->update($request->all());

        return back()->with('Info','The winning place has been updated.');
    }

    public function destroy(Place $place) {
        $place->delete();
        return back()->with('Info','A place has been deleted.');
    }
}
