<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AllInstructionsController;
use App\Http\Controllers\YourInstructionController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/register', [AuthController::class, 'create'])->name('create');

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/images/{filename}', [ArticleController::class, 'showImage'])->name('images.show');

    Route::resource('articles', ArticleController::class);
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/images/upload', [ArticleController::class, 'uploadImage'])->name('images.upload');

    Route::get('/all-instructions', [AllInstructionsController::class, 'index'])->name('all_instructions.index');
    Route::get('/all-instructions/create', [AllInstructionsController::class, 'create'])->name('all_instructions.create');
    Route::post('/all-instructions', [AllInstructionsController::class, 'store'])->name('all_instructions.store');

    Route::get('/your-instructions', [YourInstructionController::class, 'index'])->name('your_instructions.index');
    Route::get('/your-instructions/{id}', [YourInstructionController::class, 'show'])->name('your_instructions.show');
    Route::put('/your-instructions/{id}', [YourInstructionController::class, 'update'])->name('your_instructions.update');

    // Ansicht für Mitarbeiter
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');

    // Ansicht für Abteilungsleiter
    Route::get('/schedule/manage', [ScheduleController::class, 'manage'])->name('schedule.manage');
    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');



});
