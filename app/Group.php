<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function postcodes() {
        return $this->hasMany('App\Postcode')->orderBy('postcode');
    }

    public function subgroups() {
        $word = '';
        $subgroups = [];
        foreach(Postcode::where('group_id', $this->id)
                 ->orderBy('postcode')
                 ->cursor() as $postcode) {
            $words = explode(' ', $postcode->postcode);
            if(strcmp($word, $words[0]) !== 0) {
                $word = $words[0];
                $subgroup = new SubGroup();
                $subgroup->name = $words[0];
                $subgroup->postcodes = [];
                array_push($subgroups, $subgroup);
            }
            array_push($subgroup->postcodes, $postcode);
        }
        return $subgroups;
    }
}
