<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        'room_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        if ($request->hasFile('room_photo')) {
        $photoPath = $request->file('room_photo')->store('room_photos', 'public');
    }

        $data = $request->except('_token');
        $data['hotel_id'] = Session::get('hotel_id');
        $data['room_photo'] = $photoPath;

        if(Room::create($data)){
            return redirect()->route('rooms.index')->with('status', __('messages.room_added_successfully'));
        }
        return redirect()->back()->with('status', __('messages.room_add_error'));
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
            'room_photo' => 'nullable|image',
        ]);

        $room = Room::findOrFail($id);

        if ($request->hasFile('room_photo')) {
            if ($room->room_photo) {
                Storage::disk('public')->delete($room->room_photo);
            }
            $photoPath = $request->file('room_photo')->store('room_photos', 'public');
        } else {
            $photoPath = $room->room_photo;
        }

        $data = $request->except('_token');
        $data['hotel_id'] = Session::get('hotel_id');
        $data['room_photo'] = $photoPath;

        if ($room->update($data)) {
            return redirect()->route('rooms.index')->with('status', __('messages.room_updated_successfully'));
        }
        return redirect()->back()->with('status', __('messages.room_update_error'));
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
            return redirect()->back()->with('status', __('messages.room_deleted_successfully'));
        }

        return redirect()->back()->with('status', __('messages.room_delete_error'));
    }
}
