<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $guarded = [];

    public function event() {
        return $this->belongsTo('App\Models\Event');
    }
}
