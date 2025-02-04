<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\BookmarkController;

// Welcome Route
Route::get('/', function () {
    return view('welcome', ['title' => 'Welcome to AniMap']);
})->name('welcome');

// Login route
Route::get('/login', function () {
    return view('login', ['title' => 'Login to AniMap']);
})->name('login');

Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');

// Register Controller
Route::get('/register', function () {
    return view('register', ['title'=> 'Sign Up to AniMap']);
})->name('register');
Route::post('/register/create-account', [RegisterController::class, 'register'])->name('register.create-account');


// Routes with Middleware
Route::middleware(['auth'])->group(function () {
    // Route::get('/account-info', function () {
    //     return view('account-info', ['title' => 'Account Information']);
    // })->name('account-info');

    Route::get('/account-info', [AccountController::class, 'account_info'])->name('account-info');

    Route::post('/edit-profile/save-info', [AccountController::class, 'edit'])->name('account.save-info');

    Route::get('/edit-profile', function () {
        return view('edit-profile', ['title' => 'Edit Profile']);
    })->name('edit-profile');

    Route::get('/anime-list', function () {
        return view('anime-list', ['title' => 'My Anime List']);
    })->name('anime-list');
    
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

//Search Route
Route::get('/search-results', [SearchController::class, 'browse'])->name('search-results');

// Anime Info Route
Route::get('/anime-info/{id}', [AnimeController::class, 'anime_info'])->name('anime-info');

// Anime Bookmark Route
Route::post('/anime-info/update', [BookmarkController::class, 'updateAnimeList'])->name('anime-list.update');

Route::get('/anime-list/status/{mal_id}', [BookmarkController::class, 'getCurrentStatus'])->middleware('auth');


