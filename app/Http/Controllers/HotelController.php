<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin')) {
            $hotels = Hotel::all();
        }
        if(auth()->user()->hasRole('hotel-owner')) {
            $hotels = Hotel::where('user_id', auth()->id())->get();
        }
        return view('admin.hotels.index', ['hotels' => $hotels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.create');
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
        'country_id' => 'required|numeric',
        'city_id' => 'required|numeric',
        'name' => 'required',
        'stars' => 'required|numeric',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
        'zip' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except(['_token', 'image']);
        $data['user_id'] = auth()->user()->id;

        if($request->hasFile('image')){
            $file = $request->image->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            $image = $filename .' - '.time().'.'.$ext;
            Storage::putFileAs('public/hotels/', $request->image, $image);

            $data['image'] = $image;
        }

        if(Hotel::create($data)){
            return redirect()->route('hotels.index')->with('status', __('messages.hotel_added_successfully'));
        }
        return redirect()->back()->with('status', __('messages.hotel_added_failed'));
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
        return view('hotels.edit', ['hotel' => Hotel::findOrFail($id)]);
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
        'country_id' => 'required|numeric',
        'city_id' => 'required|numeric',
        'name' => 'required',
        'stars' => 'required|numeric',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
        'zip' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except(['_token', 'image']);
        $data['user_id'] = auth()->user()->id;

        if($request->hasFile('image')){
            $file = $request->image->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            $image = $filename .' - '.time().'.'.$ext;
            Storage::putFileAs('public/hotels/', $request->image, $image);

            $data['image'] = $image;
        }

        if(Hotel::find($id)->update($data)){
            return redirect()->back()->with('status', __('messages.hotel_updated_successfully'));
        }
        return redirect()->back()->with('status', __('messages.hotel_updated_failed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);

        if($hotel->delete()){
            return redirect()->back()->with('status', __('messages.hotel_deleted_successfully'));
        }

        return redirect()->back()->with('status', __('messages.hotel_delete_error'));
    }
}
