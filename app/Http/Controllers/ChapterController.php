<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\manga;

class ChapterController extends Controller
{
    public function create()
    {
        return view('layouts.createManga');
    }

    // Save the form data
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required',
            'link' => 'required|url',
            'nchapter'  => 'required|string|max:255',
            'nmanga'  => 'required',
            'date'  => 'required',

        ]);
        
        $imagePath ="";
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');  // Save image in 'storage/app/public/images'
        }
        $chapter = new Chapter();
        $chapter->image =$imagePath;
        $chapter->link = $validatedData['link'];
        $chapter->manga_id = $validatedData['nmanga'];
        $chapter->n_chapter = $validatedData['nchapter'];
        $chapter->date = $validatedData['date'];


        $chapter->save(); // Save the data to the database
        //manga::create($validatedData);
        return redirect('Dashboard');
    }

    // Show all links
    public function index()
    {
        $mangas = manga::all();
        return view('layouts.createChapter', compact('mangas'));
    }

    public function getNewestChaptersThisWeek()
    {
        $newestChapters = Chapter::where('date', '>=', Carbon::now()->startOfWeek())
                                ->where('date', '<=', Carbon::now()->endOfWeek())
                                ->orderBy('date', 'desc')
                                ->get();
        return view('layouts.newestchapters', compact('newestChapters'));
    }
}
