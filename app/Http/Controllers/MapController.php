<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function showMap() {
        $coordinates = [
            'lat' => 34.0151,
            'lng' => 71.5249,
        ];
        return view('map', compact('coordinates'));
    }
    
}
