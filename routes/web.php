<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyUserController;
use App\Http\Controllers\CreatorUserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SliderController;
use App\Models\Slider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/category/{category}', [MangaController::class, 'category'])->name('category');
Route::get('/newestmangas', [MangaController::class, 'getNewestMangasThisWeek'])->name('newestmangas');
Route::get('/newestchapters', [ChapterController::class, 'getNewestChaptersThisWeek'])->name('newestchapters');

Route::get('/top10/{delay}', [MangaController::class, 'top10'])->name('top10');
Route::get('/slider', [SliderController::class, 'show']);
Route::post('/slider', [SliderController::class, 'store']);
Route::delete('/slider/{id}', [SliderController::class, 'destroy']);

// routes/api.php

Route::post('/settings/toggle-feature', [SettingsController::class, 'toggleFeature']);
// In routes/api.php
Route::get('/settings', [SettingsController::class, 'getSettings']);




Route::get('/pp', function () {
    return view('welcome');
});

Route::get('/manga', function () {
    return view('layouts/showManga');
});
Route::get('/stories', [MangaController::class, 'showAll']);

Route::get('/links/create', [MangaController::class, 'create'])->name('links.create')->middleware('auth');
Route::post('/links', [MangaController::class, 'store'])->name('links.store');
Route::get('/', [MangaController::class, 'index'])->name('links.index');

Route::get('/chapter', [ChapterController::class, 'index'])->name('chapter.index');


Route::get('/manga/{id}', [MangaController::class, 'manga']);



Route::get('/signup', function () {
    return view('layouts/signUp');
})->name('signup');
Route::post('/signup', [UserController::class, 'store'])->name('signUp.store');



Route::get('/login', function () {
    return view('layouts/login');
})->name('login');
Route::post('/login', action: [UserController::class, 'login'])->name('login.store');
Route::get('/logout', action: [UserController::class, 'logout'])->name('login.logout');

Route::get('/Dashboard', action: [UserController::class, 'lead'])->name('Dashboard');

Route::prefix('Dashboard')->middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('layouts/dashboard/admin');
    })->middleware(['role:admin']);
    Route::post('/admin/slider', [SliderController::class, 'mUpdate'])->middleware(['role:admin']);
    Route::get('/admin/slider', [SliderController::class, 'show'])->middleware(['role:admin']);

    Route::get('/companyUser', [CompanyUserController::class, 'index']) ->name('companyUser.index')->middleware(['role:company_user']);
    Route::post('/companyUser', [CompanyUserController::class, 'index'])->name('companyUser.store')->middleware(['role:company_user']);

    Route::get('/creatorUser',[CreatorUserController::class, 'index'] )->name('creatorUser.index')->middleware(['role:creator_user']);
    Route::post('/creatorUser', [UserController::class, 'settings'])->name('creatorUser.store')->middleware(['role:creator_user']);
    Route::get('/myStories', [MangaController::class, 'userStories'])->middleware('auth:sanctum');

    Route::get('/subscribe', [MangaController::class, 'subscribe'])->name('manga.subscribe')->middleware(['role:creator_user']);

    Route::post('/serie/create', [MangaController::class, 'storeForC'])->name('serie.create')->middleware(['role:company_user']);
    Route::post('/chapter', [ChapterController::class, 'store'])->name('chapter.store');


    Route::post('/posts/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/Serie/{id}', [MangaController::class, 'show']);
    Route::post('/Serie/{id}', [MangaController::class, 'update']);
    Route::delete('/Serie/{id}', [MangaController::class, 'destroy']);


});




