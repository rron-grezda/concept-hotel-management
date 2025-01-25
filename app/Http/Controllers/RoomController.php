<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('hotel-id') == null) {
            return redirect()->route('hotels.index');
        }

        session(['hotel_id' => $request->get('hotel-id')]);
        $hotel = Hotel::findOrFail($request->get('hotel-id'));

        return view('hotels.rooms.index', ['rooms' => $hotel->rooms()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'type' => 'required',
        'guests' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'description' => 'required',
        ]);

        $data = $request->except('_token');
        $data['hotel_id'] = Session::get('hotel_id');

        if(Room::create($data)){
            return redirect()->route('rooms.index')->with('status', 'Dhoma u shtua me sukses.');
        }
        return redirect()->back()->with('status', 'Dhoma nuk u shtua - diçka shkoi keq!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('hotels.rooms.edit', ['room' => Room::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'type' => 'required',
        'guests' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'description' => 'required',
        ]);

        $data = $request->except('_token');
        $data['hotel_id'] = Session::get('hotel_id');

        if(Room::findOrFail($id)->update($data)){
            return redirect()->route('rooms.index')->with('status', 'Dhoma u përditësua me sukses.');
        }
        return redirect()->back()->with('status', 'Dhoma nuk u përditësua - diçka shkoi keq!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $room = Room::findOrFail($id);

        if($room->delete()){
            return redirect()->back()->with('status', 'Dhoma u fshi me sukses.');
        }

        return redirect()->back()->with('status', 'Dhoma nuk u fshi - diçka shkoi keq!');
    }
}
