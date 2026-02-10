<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all()->map(function($hotel){
            $hotel->image_url = $hotel->image ? url('storage/'.$hotel->image) : null;
            return $hotel;
        });
        return response()->json($hotels);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'price'=>'nullable|numeric',
            'image'=>'nullable|image|max:2048',
        ]);

        $path = $request->hasFile('image') ? $request->file('image')->store('hotels','public') : null;

        $hotel = Hotel::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'price'=>$request->price,
            'currency'=>$request->currency,
            'image'=>$path,
        ]);

        $hotel->image_url = $path ? url('storage/'.$path) : null;

        return response()->json(['hotel'=>$hotel]);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name'=>'required|string',
            'price'=>'nullable|numeric',
            'image'=>'nullable|image|max:2048',
        ]);

        if($request->hasFile('image')){
            if($hotel->image) Storage::disk('public')->delete($hotel->image);
            $hotel->image = $request->file('image')->store('hotels','public');
        }

        $hotel->update($request->only(['name','address','email','phone','price','currency']));

        $hotel->image_url = $hotel->image ? url('storage/'.$hotel->image) : null;

        return response()->json(['hotel'=>$hotel]);
    }

    public function destroy(Hotel $hotel)
    {
        if($hotel->image) Storage::disk('public')->delete($hotel->image);
        $hotel->delete();
        return response()->json(['message'=>'Supprimé']);
    }
}
