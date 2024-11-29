<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['manga_id'];


    /*public function mUpdate(Request $request){
        // Validate the request inputs
        $request->validate([
            'image1' => 'nullable',
            'mangaId1' => 'required|string',
            'image2' => 'nullable',
            'mangaId2' => 'required|string',
            'image3' => 'nullable',
            'mangaId3' => 'required|string',
            'image4' => 'nullable',
            'mangaId4' => 'required|string',
            'image5' => 'nullable',
            'mangaId5' => 'required|string',
            'image6' => 'nullable',
            'mangaId6' => 'required|string',
        ]);

        // Loop through each slider data and save it
        for ($i = 1; $i <= 6; $i++) {
            // Check if the image file exists
            if ($request->hasFile("image{$i}")) {
                // Store the image in the 'public/sliders' directory
                $imagePath = $request->file("image{$i}")->store('images', 'public');

                // Save the slider data to the database
                Slider::create([
                    'image' => $imagePath,
                    'manga_id' => $request->input("mangaId{$i}"),
                ]);
            } else {
                // If there's no image, just save the manga ID with a null image
                Slider::create([
                    'image' => null,
                    'manga_id' => $request->input("mangaId{$i}"),
                ]);
            }
        }

        return response()->json([
            'message' => 'Sliders saved successfully!',
        ]);
    }*/
    // App\Models\Slider.php



    /*public function show(){
        $slider = Slider::All();
        return response()->json(['data' => '$slider'], 200);
    }*/
    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

}
