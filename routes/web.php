<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['title' => 'Welcome to AniMap']);
})->name('welcome');

Route::get('/login', function () {
    return view('login', ['title'=> 'Login']);
})->name('login');

Route::get('/register', function () {
    return view('register', ['title'=> 'Login']);
})->name('register');

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

Route::get('/test', function () {
    return view('test');
})->name('test');

