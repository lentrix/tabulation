<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'in_charge' => 'string|required'
        ]);

        Competition::create($request->all());

        return back()->with('Info','A new competition has been added.');
    }

    public function update(Request $request, Competition $competition) {
        $request->validate([
            'name' => 'string|required',
            'in_charge' => 'string|required'
        ]);

        $competition->update($request->all());

        return back()->with('Info','The competition has been updated.');
    }

    public function destroy(Competition $competition) {
        $name = $competition->name;
        $competition->delete();
        return back()->with('Info',"The competition $name has been deleted.");
    }
}
