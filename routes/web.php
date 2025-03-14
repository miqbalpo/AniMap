<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AnimeInfoController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\AnimeListController;
use App\Http\Controllers\RecommendationController;

// Routes for Guests
Route::middleware(['guest'])->group(function () {
    // Welcome Route
    Route::get('/', function () {
        return view('welcome', ['title' => 'Welcome to AniMap']);
    })->name('welcome');

    // Login route
    Route::get('/login', function () {
        return view('login', ['title' => 'Login to AniMap']);
    })->name('login');

    Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');

    // Register route
    Route::get('/register', function () {
        return view('register', ['title'=> 'Sign Up to AniMap']);
    })->name('register');

    Route::post('/register/create-account', [RegisterController::class, 'register'])->name('register.create-account');
});

// Routes for Users
Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    // Anime Recommendations Home Route
    Route::get('/home', [RecommendationController::class, 'homepage'])->name('home');

    // Anime Bookmark Route
    Route::post('/anime-info/update', [BookmarkController::class, 'updateAnimeList'])->name('anime-list.update');

    Route::get('/anime-list/status/{mal_id}', [BookmarkController::class, 'getCurrentStatus']);

    //Account Info Route
    Route::get('/account-info', [AccountController::class, 'account_info'])->name('account-info');

    Route::get('/edit-profile', function () {
        return view('edit-profile', ['title' => 'Edit Profile']);
    })->name('edit-profile');

    Route::post('/edit-profile/save-info', [AccountController::class, 'edit'])->name('account.save-info');

    // Anime List Route
    Route::get('/anime-list', [AnimeListController::class, 'index'])->name('anime-list');

    // Logout Route
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

//Search Route
Route::get('/search-results', [SearchController::class, 'browse'])->name('search-results');

// Anime Info Route
Route::get('/anime-info/{id}', [AnimeInfoController::class, 'anime_info'])->name('anime-info');

Route::get('/anime-info/status/{mal_id}', [BookmarkController::class, 'getCurrentStatus'])->middleware('auth');

// Error 404 Route
Route::fallback(function(){
    return view('errors.404',[ 'title' => 'Page Not Found']);
});
