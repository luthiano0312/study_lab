<?php

use Illuminate\Support\Facades\Route;
use App\Models\Subject;
use App\Models\Activity;
use App\Models\Exam;

Route::get('/', fn() => view('index'));

Route::get('/login',    fn() => view('auth/login'))->name('login');
Route::get('/register', fn() => view('auth/register'))->name('register');
Route::get('/forgot',   fn() => view('auth/forgot-password'));
Route::get('/dashboard', fn() => view('dashboard'));
Route::get('/profile',  fn() => view('profile.profile'))->name('profile');


Route::get('/subject', function () {
    return view('subjects/index');
});
Route::get('/horary', function () {
    return view('horary/index');
});
Route::get('/notes', function () {
    return view('notes/index');
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


Route::get('/exams', fn() => view('notes.exam.index'))->name('exam.index');
Route::get('/exams/create', fn() => view('notes.exam.create'))->name('exam.create');
Route::get('/exams/edit/{id}', function ($id) {
    $exam = Exam::findOrFail($id);
    return view('notes.exam.edit', compact('exam'));
})->name('exam.edit');