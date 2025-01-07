<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['user' => 'miqbalpo']);
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/test', function () {
    return view('test');
});

