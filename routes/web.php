<?php

use Illuminate\Support\Facades\Route;
use App\Models\Subject;
use App\Models\Activity;

Route::get('/', fn() => view('index'));

Route::get('/login',     fn() => view('auth/login'));
Route::get('/register',  fn() => view('auth/register'));
Route::get('/forgot',    fn() => view('auth/forgot-password'));
Route::get('/dashboard', fn() => view('dashboard'));

Route::get('/subject', function () {
    return view('subjects/index');
});


Route::get('/subjects', fn() => view('subjects.subject.index'))->name('subject.index');
Route::get('/subjects/create', fn() => view('subjects.subject.create'))->name('subject.create');
Route::get('/subjects/edit/{id}', function ($id) {
    $subject = Subject::findOrFail($id);
    return view('subjects.subject.edit', compact('subject'));
})->name('subject.edit');

Route::get('/activities', fn() => view('subjects.activities.index'))->name('activity.index');
Route::get('/activities/create', fn() => view('subjects.activities.create'))->name('activity.create');
Route::get('/activities/edit/{id}', function ($id) {
    $activity = Activity::findOrFail($id);
    return view('subjects.activities.edit', compact('activity'));
})->name('activity.edit');