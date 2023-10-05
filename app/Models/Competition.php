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
}
