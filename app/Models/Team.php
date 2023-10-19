<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    public function event() {
        return $this->belongsTo('App\Models\Team');
    }

    public function placers() {
        return $this->hasMany('App\Models\Placer');
    }

    public function getTotalPointsAttribute() {
        $total = 0;
        foreach($this->placers as $placer) {
            $total += $placer->custom_weight;
        }
        return $total;
    }

    public function countPlace(Place $place) {
        return Placer::where('place_id', $place->id)
                ->where('team_id', $this->id)
                ->count();
    }
}
