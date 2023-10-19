<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    protected $guarded = [];

    public function teams() {
        return $this->hasMany('App\Models\Team')->orderBy('name');
    }

    public function places() {
        return $this->hasMany('App\Models\Place')->orderBy('default_weight','desc');
    }

    public function competitions() {
        return $this->hasMany('App\Models\Competition')->orderBy('name');
    }

    public function medalSummary() {
        $data = [];
        $places = $this->places;

        foreach($this->teams as $tm) {
            $medals = [];
            $medals['team'] = $tm->name;

            foreach($places as $p) {
                $medals[$p->label] = $tm->countPlace($p);
            }
            $data[] = $medals;
        }

        return $data;
    }
}
