<?php

use Illuminate\Support\Facades\Route;
use App\Models\Subject;

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

Route::get('/subject', function () {
    return view('subjects/index');
});

Route::get('/subjects', fn() => view('subjects.subject.index'))->name('subject.index');

Route::get('/subjects/create', fn() => view('subjects.subject.create'))->name('subject.create');

Route::get('/subjects/edit/{id}', function ($id) {
    $subject = Subject::findOrFail($id);
    return view('subjects.subject.edit', compact('subject'));
})->name('subject.edit');