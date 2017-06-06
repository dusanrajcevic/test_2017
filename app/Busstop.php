<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Busstop extends Model
{
    public function postcode() {
        return $this->belongsTo('App\Postcode');
    }
}
