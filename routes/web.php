<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\TodoController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/register', [AuthController::class, 'create'])->name('create');

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Article routes
    Route::resource('articles', ArticleController::class);
    Route::get('/images/{filename}', [ArticleController::class, 'showImage'])->name('images.show');
    Route::get('/articles-debug', [ArticleController::class, 'debug'])->name('articles.debug');
    Route::get('/test-upload', [ArticleController::class, 'testUpload'])->name('test.upload.form');
    Route::post('/test-upload', [ArticleController::class, 'testUpload'])->name('test.upload');

    Route::get('/instructions', [InstructionController::class, 'index'])->name('instructions.index');
    Route::get('/instructions/create', [InstructionController::class, 'create'])->name('instructions.create');
    Route::post('/instructions', [InstructionController::class, 'store'])->name('instructions.store');
    Route::get('/instructions/all', [InstructionController::class, 'all'])->name('instructions.all');
    Route::get('/instructions/{id}', [InstructionController::class, 'show'])->name('instructions.show');
    Route::put('/instructions/{id}', [InstructionController::class, 'update'])->name('instructions.update');

    // Ansicht für Mitarbeiter
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');

    // Ansicht für Abteilungsleiter
    Route::get('/schedule/manage', [ScheduleController::class, 'manage'])->name('schedule.manage');
    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');

    // Ansicht für Mitarbeiter
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/trainings/dashboard', [TrainingController::class, 'dashboard'])->name('trainings.dashboard');
        Route::get('/trainings/create', [TrainingController::class, 'create'])->name('trainings.create');
        Route::post('/trainings', [TrainingController::class, 'store'])->name('trainings.store');
        Route::get('/trainings/{id}', [TrainingController::class, 'show'])->name('trainings.show');
        Route::get('/trainings/{id}/confirm', [TrainingController::class, 'confirm'])->name('trainings.confirm');
        Route::post('/trainings/{id}/confirm', [TrainingController::class, 'confirmStore'])->name('trainings.confirm.store');
    });

    // Ansicht für Admin
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/trainings', [TrainingController::class, 'index'])->name('trainings.index');
        Route::post('/trainings/{id}/reject', [TrainingController::class, 'reject'])->name('trainings.reject');
    });

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/users', [ChatController::class, 'getAllUsers'])->name('chat.users');
    Route::post('/chat/search', [ChatController::class, 'search'])->name('chat.search');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');

    Route::get('/kalender', [CalendarController::class, 'index'])->name('calendar.index');

    // Todo Routes
    Route::resource('todos', TodoController::class);
    Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggleStatus'])->name('todos.toggle');

   
    });

Route::middleware('auth')->group(function() {
    Route::post('/calendar/events', [CalendarEventController::class, 'store'])->name('calendar.events.store');
    Route::get('/calendar/events', [CalendarEventController::class, 'index'])->name('calendar.events.index');
});
