<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AnimeInfoController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\AnimeListController;

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
    // Anime Bookmark Route
    Route::post('/anime-info/update', [BookmarkController::class, 'updateAnimeList'])->name('anime-list.update');
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
Route::get('/anime-list/status/{mal_id}', [BookmarkController::class, 'getCurrentStatus'])->middleware('auth');


