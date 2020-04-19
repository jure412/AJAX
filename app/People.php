<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    public function types() {
        return $this->belongsToMany('App\Type', 'people_type')->withTimestamps();
    }
}
