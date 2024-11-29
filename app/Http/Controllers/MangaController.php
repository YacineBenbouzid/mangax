<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\subscriber;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\manga;
use Log;
use Storage;




class MangaController extends Controller
{
    public function show($id){
        $Serie =manga::find($id);
        return response()->json(['data' => $Serie ]);

    }
    public function showAll(){
        $Series =manga::all();
        return response()->json(['data' => $Series ]);

    }
    public function create()
    {
        return view('layouts.createManga');
    }

    // Save the form data
    public function store(Request $request)
    {

        //            'type' => 'in:value1,value2,value3',

        $validatedData = $request->validate([
            'image' => 'required',
            'banner' => 'required',
            'description' => 'required',
            'name'  => 'required|string|max:255',
            'type'  => 'required|string|max:255',

            'genre_1' => 'required|string|max:50',
            'genre_2' => 'nullable|string|max:50',
            'genre_3' => 'nullable|string|max:50',

        ]);

        $imagePath ="";
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');  // Save image in 'storage/app/public/images'
            $imagePath2 = $request->file('banner')->store('images', 'public');  // Save image in 'storage/app/public/images'
        }

        try {
            $manga = new Manga();
            $manga->image = $imagePath;
            $manga->banner = $imagePath2;
            $manga->description = $validatedData['description'];
            $manga->name = $validatedData['name'];
            $manga->type = $validatedData['type'];
            $manga->genre_1 = $validatedData['genre_1'];
            $manga->genre_2 = $validatedData['genre_2'] ?? null;
            $manga->genre_3 = $validatedData['genre_3'] ?? null;
            $manga->user_id = auth()->id(); // Use authenticated user ID
            $manga->save();
    
            return response()->json(['message' => 'Series created successfully!'], 201);
        } catch (QueryException $e) {
            // Log the error for debugging
            \Log::error('Error saving manga: ' . $e->getMessage());
    
            return response()->json(['message' => 'Failed to create series: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Catch any other exceptions
            \Log::error('An unexpected error occurred: ' . $e->getMessage());
    
            return response()->json(['message' => 'An unexpected error occurred. Please try again later.'], 500);
        }

        /* // Save the data to the database*/
        //manga::create($validatedData);
        //return response()->json(['message' => 'Series created successfully!', 'series' => $manga], 201);
        //return redirect('Dashboard');
    }

    public function storeForC(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
            'name'  => 'required|string|max:255',
            'link'  => 'required|url',
            'genre_1' => 'required|string|max:50',
            'genre_2' => 'nullable|string|max:50',
            'genre_3' => 'nullable|string|max:50',
            'type' => 'nullable|string|max:50',

        ]);
    
        if ($request->hasFile('image')) {
            // Store image in 'storage/app/public/images'
            $imagePath = $request->file('image')->store('images', 'public');
        }
    
        $manga = new Manga();
        $manga->image = $imagePath ?? '';
        $manga->link = $validatedData['link'];
        $manga->name = $validatedData['name'];
        $manga->genre_1 = $validatedData['genre_1'];
        $manga->genre_2 = $validatedData['genre_2'] ?? null;
        $manga->genre_3 = $validatedData['genre_3'] ?? null;
        $manga->type = $validatedData['type'] ?? null;

        $manga->user_id = auth()->id();
        
        $manga->save();
    
        return redirect('Dashboard');
    }
    

    // Show all links
    public function index()
    {
        $links = manga::all();
        $mangas_10 = Manga::orderBy('nvw', 'desc')->take(10)->get();
        $recentMangas = Manga::orderBy('created_at', 'desc')->take(10)->get();
        $newAndTrending = Manga::where('created_at', '>=', Carbon::now()->subMonth())
                               ->orderBy('nviews', 'desc')
                               ->take(10) // Limit to 10 items
                               ->get();


        $smanga = Manga::where('created_at', '>=', Carbon::now()->subWeeks(2))
        ->orderBy('nvm', 'desc')
        ->take(1) 
        ->first();
                
    $chapters = $smanga ? $smanga->chapters()->get() : collect();
    //$smanga = manga::find(20);


    $featureEnabled = Setting::value('feature_enabled');
    if ($featureEnabled == false) {
        // Retrieve the top 6 most viewed manga of the week
        $slider = Manga::orderBy('nvw', 'desc')
                        ->take(6)
                        ->get();

        /*$slider = $slider->map(function ($item) {
            $item->manga_id = $item->id;
            unset($item->id);
            return $item;
        });*/

    } else {
        // Retrieve all sliders
        $sliders = Slider::with('manga')->get();
        $slider = $sliders->pluck('manga')->flatten();

        /*$slider = $slider->map(function ($item) {
            $item->banner = $item->image;
            unset($item->image);
            return $item;
        });*/
    }

        return view('layouts.home', compact('links','mangas_10','recentMangas','newAndTrending','smanga','chapters','slider'));
    }
    
    public function manga($id){
        $id = (int) $id;

        $chapters = manga::find($id)->chapters()->get();
        $manga = manga::find($id);
        $manga->increment('nviews');
        $manga->increment('nvd');
        $manga->increment('nvw');

        $manga->increment('nvm');


        $sub=false;
        if (Auth::check()) {
            $rs = subscriber::where('user_id', auth()->user()->id)
            ->where('manga_id', $id)
            ->get();
        if(!$rs->isEmpty()) {

            $sub= true;
        }else{
            $sub=false;

        }}
        $comments = Comment::where('manga_id', $id)
            ->with('user')
            ->get();
        return view('layouts.showManga', compact('chapters','comments','manga','sub'));

    }
    public function subscribe(Request $request){
        $validatedData = $request->validate([
            'user_id' => 'required',
            'manga_id' => 'required',
        ]);
        $rs = subscriber::where('user_id', $validatedData['user_id'])
                ->where('manga_id', $validatedData['manga_id'])
                ->get();

        if(!$rs->isEmpty()) {
            foreach ($rs as $record) {
                $record->delete();
            }
            return back()->with('sub', 'no');

        } else {

            $subscribe = new subscriber();
            $subscribe->manga_id = $validatedData['manga_id'];
            $subscribe->user_id = $validatedData['user_id'];
            
            $subscribe->save(); // Save the data to the database
            return back()->with('sub', 'ok');

        }

    }
    public static function subState( $id){

        if (!Auth::check()) {
            $rs = subscriber::where('user_id', auth()->user()->id)
            ->where('manga_id', $id)
            ->get();

    if(!$rs->isEmpty()) {
        return true;
    }else{
        return false;
    }
        }else{
            return false;
        }

    }


    public function userStories(){
        $user = Auth::user(); // Get the authenticated user
        // Fetch all mangas for the user
        $mangas = $user->mangas;

        return response()->json($mangas);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'genre_1' => 'required|string|max:100', 
            'genre_2' => 'nullable|string|max:100', 
            'genre_3' => 'nullable|string|max:100', 
            'image' => 'nullable', 
            'type' => 'required|string|max:255', 
        ]);

        // Find the manga by ID
        $manga = Manga::findOrFail($id);
        $imagePath ="";
        if ($request->hasFile('image')) {
            if ($manga->image) {
                $imagePathOld = $manga->image; // This is the stored image path
        
                // Check if the image exists in the storage and delete it
                if (Storage::disk('public')->exists($imagePathOld)) {
                    Storage::disk('public')->delete($imagePathOld);
                }
            }
            $imagePath = $request->file('image')->store('images', 'public');  
            $manga->image = $imagePath;
        }

        $manga->name = $validatedData['name'];
        $manga->description = $validatedData['description'];
        $manga->genre_1 = $validatedData['genre_1'] ?? $manga->genre; 
        $manga->genre_2 = $validatedData['genre_2'] ?? $manga->genre; 
        $manga->genre_3 = $validatedData['genre_3'] ?? $manga->genre; 
        $manga->type = $validatedData['type'] ?? $manga->author;

        $manga->save();

        return response()->json(['message' => 'Manga updated successfully']);
    }

    public function destroy($id)
    {
        // Find the manga by ID
        $manga = Manga::findOrFail($id);
        if ($manga->image) {
            $imagePath = $manga->image; // This is the stored image path
    
            // Check if the image exists in the storage and delete it
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        // Delete the manga
        $manga->delete();

        // Return a success response
        return response()->json(['message' => 'Manga deleted successfully']);
    }

    public function category($category)
    {
        // Select all mangas where the 'type' column matches the $category
        $mangas = Manga::where('genre_1', $category)
        ->orWhere('genre_2', $category)
        ->orWhere('genre_3', $category)
        ->get();
    

        // Return the view with the selected mangas
        return view('layouts/category', compact('mangas', 'category'));
    }
    public function top10($Duration)
{
    $col='';

    // Set the date range based on the Duration

    switch ($Duration) {
        case 'day':
            $col='nvd';
            break;
        case 'week':
            $col='nvw';
            break;
        case 'month':
            $col='nvm';
            break;
        default:
            // If Duration is not recognized, return an error response
            return response()->json(['error' => 'Invalid duration specified.'], 400);
    }

    // Fetch top 10 mangas ordered by views within the specified date range
    $Serie = Manga::orderBy($col, 'desc')
                  ->take(10)
                  ->get();

    // Return the selected mangas as JSON
    return response()->json(['data' => $Serie]);
}

    public function getNewestMangasThisWeek()
    {
        $newestMangas = Manga::where('created_at', '>=', Carbon::now()->startOfWeek())
                            ->where('created_at', '<=', Carbon::now()->endOfWeek())
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('layouts.newestmangas', compact('newestMangas'));

    }
}
