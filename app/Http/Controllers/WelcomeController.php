<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function index(Request $request){
        return view('welcome');
    }

    function search(Request $request){
        $request->validate([
        'hotel' => 'required',
        'country' => 'required|numeric',
        'city' => 'required|numeric',
        ]);

        $hotels = Hotel::where('name', 'LIKE', '%'.$request->hotel.'%')
        ->where('country_id', $request->country)
        ->where('city_id', $request->city)
        ->paginate(20);

        return view('search', ['hotels' => $hotels]);
    }
}
