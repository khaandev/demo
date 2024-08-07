<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckUserHasNoActivity;
use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('activites/create', [ActivityController::class, 'create'])
    ->middleware(CheckUserHasNoActivity::class)
    ->name('activites.create');

Route::resource('activites', ActivityController::class)->except(['create']);

require __DIR__ . '/auth.php';
