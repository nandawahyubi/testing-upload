<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function show(Image $image){
        return view('show', compact('image'));
    }
    
    public function store(Request $request){
        $validated = $request->validate(
            [
                'image' => 'required|image|mimes:png,jpg,jpeg|max:512'
            ]
        );

        if($request->file('image')){
            $validated['image'] = $request->file('image')->store('proof-of-payment');
        }

        Image::create($validated);
        return back()->with('success', 'Data Image Berhasil Di Upload');
    }
}
