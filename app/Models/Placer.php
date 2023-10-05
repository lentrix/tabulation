<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placer extends Model
{
    protected $guarded = [];

    public function place() {
        return $this->belongsTo(('App\Models\Place'));
    }

    public function competition() {
        return $this->belongsTo('App\Models\Competition');
    }

    public function team() {
        return $this->belongsTo('App\Models\Team');
    }
}
