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
}
