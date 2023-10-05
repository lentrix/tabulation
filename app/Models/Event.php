<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function teams() {
        return $this->hasMany('App\Models\Team');
    }

    public function places() {
        return $this->hasMany('App\Models\Place');
    }

    public function competition() {
        return $this->hasMany('App\Models\Competition');
    }
}
