<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\ChatController;

Route::prefix('chat')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/search', [ChatController::class, 'search'])->name('chat.search');
    Route::post('/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});
