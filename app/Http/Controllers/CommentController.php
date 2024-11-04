<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\manga;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|max:500',
            'id' => 'required'
        ]);
        //dd($validatedData['id']);
        Comment::create([
            'user_id' => Auth::id(),
            'manga_id' => $request->id,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
