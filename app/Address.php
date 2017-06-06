<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function postcode() {
    	return $this->belongsTo('App\Postcode');
    }
}
