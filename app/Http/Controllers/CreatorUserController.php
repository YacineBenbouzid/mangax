<?php

namespace App\Http\Controllers;

use App\Models\manga;
use Auth;
use Illuminate\Http\Request;

class CreatorUserController extends Controller
{
    public function index(){

        $mangas = manga::where('user_id',Auth::user()->id)->get();
        return view('layouts/Dashboard.creatorUser', compact('mangas'));
    }
}
