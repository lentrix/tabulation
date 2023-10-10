<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $guarded = [];

    public function event() {
        return $this->belongsTo('App\Models\Event');
    }

    public function placers() {
        return $this->hasMany('App\Models\Placer');
    }

    public function getTeamResultsAttribute() {
        $teamResults = [];

        foreach($this->event->teams as $team) {
            $placer = Placer::where('team_id', $team->id)->where('competition_id', $this->id)->first();
            $teamResults[] = [
                'team_id' => $team->id,
                'team_name' => $team->name,
                'place' => $placer?->place
            ];
        }

        return $teamResults;
    }
}
