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

Route::get('/anime-information', function () {
    return view('anime-information', ['title' => 'Anime Search']);
})->name('anime-information');

Route::get('/test', function () {
    return view('test');
})->name('test');

