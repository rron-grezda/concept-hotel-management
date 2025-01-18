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

    function bookings(){
        if(auth()->user()->hasRole('admin')){
            $bookings = DB::table('bookings')->select('*')->get();
        }
        if(auth()->user()->hasRole('hotel-owner')){
            $rooms = Room::where('hotel_id', auth()->id())->get()->pluck('id')->toArray();
            $bookings = DB::table('bookings')->whereIn('rom_id', $rooms)->get();
        }
        if(auth()->user()->hasRole('client')){
        $bookings = DB::table('bookings')->select('*')->where('user_id', auth()->id())->get();
        }

        return view('shared.bookings.index', ['bookings' => $bookings]);
    }

    function delete($id){
        if(DB::table('bookings')->delete($id)){
            return redirect()->back()->with('status', 'Rezervimi u fshi me sukses.');
        }

        return redirect()->back()->with('status', 'Rezervimi nuk u fshi - diçka shkoi keq!');
    }
}
