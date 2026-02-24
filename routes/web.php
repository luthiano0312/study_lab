<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/forgot', function () {
    return view('auth/forgot-password');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});