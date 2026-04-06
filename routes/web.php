    <?php

use Illuminate\Support\Facades\Route;
use App\Models\Subject;
use App\Models\Activity;
use App\Models\Exam;
use App\Models\Content;
use App\Http\Controllers\Api\SocialAuthController;

    Route::get('/', fn() => view('index'));
    Route::get('/login', fn() => view('auth/login'))->name('login');
    Route::get('/register', fn() => view('auth/register'))->name('register');
    Route::get('/forgot', fn() => view('auth/forgot-password'));
    Route::get('/dashboard', fn() => view('dashboard'));
    Route::get('/profile', fn() => view('profile.profile'))->name('profile');

    // Google OAuth (viam web routes para ter acesso à session)
    Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [SocialAuthController::class, 'callback'])->name('google.callback');

    Route::get('/onboarding', fn() => view('onboarding'))->name('onboarding');
    Route::get('/focus', fn() => view('focus.index'))->name('focus');





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

    Route::get('/contents', fn() => view('subjects.content.index'))->name('content.index');
    Route::get('/contents/create', fn() => view('subjects.content.create'))->name('content.create');
    Route::get('/contents/edit/{id}', function ($id) {
        $content = Content::findOrFail($id);
        return view('subjects.content.edit', compact('content'));
    })->name('content.edit');

    Route::get('/horary', fn() => view('horary.photo.index'))->name('horary.index');
    Route::get('/horary/create', fn() => view('horary.photo.create'))->name('horary.create');
    Route::get('/horary/edit/{id}', function ($id) {
        $horary = Horary::findOrFail($id);
        return view('horary.photo.edit', compact('horary'));
    })->name('horary.edit');
