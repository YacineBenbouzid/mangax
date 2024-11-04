<?php

namespace App\Http\Controllers;

use App\Models\manga;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'manga_id' => 'required|string|max:255',
            'image' => 'required|file', 
        ]);

        $imagePath = "";
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $slider = Slider::create([
            'manga_id' => $request->manga_id,
            'image' => $imagePath,
        ]);

        return response()->json(['story' => $slider], 201);
    }

    public function show()
{
    $sliders = Slider::all();
    return response()->json(['data' => $sliders], 200);
}


    public function destroy($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return response()->json(['error' => 'Slider not found'], 404);
        }

        // Delete the image file from storage if it exists
        if ($slider->image && \Storage::disk('public')->exists($slider->image)) {
            \Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return response()->json(['message' => 'Slider deleted successfully'], 200);
    }
}
