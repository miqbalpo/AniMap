<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['user' => 'miqbalpo']);
});

Route::get('/login', function () {
    return view('login', ['title'=> 'Login']);
});

Route::get('/register', function () {
    return view('register', ['title'=> 'Login']);
});

Route::get('/test', function () {
    return view('test');
});

