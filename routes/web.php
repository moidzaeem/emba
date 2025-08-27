<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CustomClassController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('participants', ParticipantController::class);
Route::post('/participants/import', [ParticipantController::class, 'import'])->name('participants.import');

// Course management
Route::resource('courses', CourseController::class);
Route::resource('classes', CustomClassController::class);

// Group generation
Route::get('/groups/generate', [GroupController::class, 'showGenerateForm'])->name('groups.generate.form');
Route::post('/groups/generate', [GroupController::class, 'generate'])->name('groups.generate');

// Group history
Route::get('/groups/history', [GroupController::class, 'history'])->name('groups.history');
Route::get('/groups/export/{courseId}', [GroupController::class, 'export'])->name('groups.export');

// Admin settings

Route::get('/migrate', function () {
    \Artisan::call('migrate');
    return redirect()->back()->with('status', 'Migration completed!');
});