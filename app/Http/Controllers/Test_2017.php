<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postcode;
use App\Group;
class Test_2017 extends Controller
{
    public function home() {
        $groups = Group::all();

        return view('home', compact('groups'));
    }

    private function detailsForView($view, $id, $distance = 20, $num_of_busstops = 5) {

    	$groups = Group::all();

        $postcode = Postcode::where('id', $id)->first();
        
        $schools = $postcode->schoolsCloserThan($distance);

        $busstops = $postcode->closestBusstops($num_of_busstops);

        return view($view, compact('groups',
                                    'schools',
                                    'postcode',
                                    'busstops',
                                    'num_of_busstops',
                                    'distance'));
    
    }

    public function details($id) {
    	return $this->detailsForView('home', $id);
    }

    public function detailsWithDistance($id) {
        return $this->detailsForView('home_with_km', $id);   
    }
}
