<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BookController;

class BookController extends Controller
{
    function book(Request $request){
        $request->validate([
            'checkin'=>'required|date|after_or_equal:now',
            'checkout'=>'required|date|after:checkin',
            'guests'=>'required|numeric',
        ]);

        if(DB::table('bookings')->insert([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'guests' => $request->guests
        ])) {
            return redirect()->back()->with('status', 'Rezervimi u krye me sukses.');
        }

        return redirect()->back()->with('status', 'Rezervimi u anulua - diçka shkoi keq!');
        
    }
}
