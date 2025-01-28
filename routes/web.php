<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Page Routes
Route::get('/', function () {
    return view('welcome', ['title' => 'Welcome to AniMap']);
})->name('welcome');

Route::get('/search-results', function () {
    return view('search-results', ['title' => 'Anime Search']);
})->name('search-results');

Route::get('/anime-info', function () {
    return view('anime-info', ['title' => 'Anime Search']);
})->name('anime-info');

Route::get('/account-info', function () {
    return view('account-info', ['title' => 'Account Information']);
})->name('account-info');

Route::get('/anime-list', function () {
    return view('anime-list', ['title' => 'My Anime List']);
})->name('anime-list');



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


// Logout Route
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


