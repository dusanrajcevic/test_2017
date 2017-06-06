<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function busstops() {

        return $this->hasMany('App\Busstop');
    }

    public function addresses() {
        return $this->hasMany('App\Address')->orderBy('street');
    }

    public function schools() {
        return $this->hasMany('App\School');
    }

    /**
     *  @param $num_of_busstops
     *  @return Busstop[]
     */
    public function closestBusstops($num_of_busstops) {
        $busstops = Busstop::with('postcode')->orderBy('postcode_id')->get();
        $t = $this;
        $busstops = $busstops->sortBy(function($bus1) use (&$t) {
            return $t->distance($bus1->postcode);
        })->values()->all();
        
        return array_slice($busstops, 0, $num_of_busstops);
    }

    /**
     *  @param $km double
     *  @return School[]
     */
    public function schoolsCloserThan($km) {
        $schools = School::with('postcode')->get();
        $close_schools = [];
        foreach($schools as $school) {
            $distance = $this->distance($school->postcode);
            if($distance <= $km)
                array_push($close_schools, $school);
        }
        return $close_schools;
    }

    /**
     *  @param $postcode Postcode
     *  @return double
     */
    public function distance($postcode) {
        $fi1 = deg2rad($postcode->latitude);
        $fi2 = deg2rad($this->latitude);
        $dfi = deg2rad($this->latitude - $postcode->latitude);
        $dlambda = deg2rad($this->longitude - $postcode->longitude);

        $a = sin($dfi/2) * sin($dfi/2) +
            cos($fi1) * cos($fi2) *
            sin($dlambda / 2) * sin ($dlambda / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return 6371 * $c;
    }
}

