<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
