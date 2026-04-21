<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (No Login Required)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/', [NoteController::class, 'login'])->name('login');
    Route::get('/auth', [NoteController::class, 'login'])->name('auth');

    Route::get('/register', [NoteController::class, 'showRegister'])->name('register');
    Route::post('/register', [NoteController::class, 'register'])->name('register.perform');

    Route::post('/login', [NoteController::class, 'authenticate'])->name('login.authenticate');
});


/*
|--------------------------------------------------------------------------
| Protected Routes (Login Required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [NoteController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/dashboard/{note}', [NoteController::class, 'show'])->name('notes.showNote');

    Route::post('/notes', [NoteController::class, 'store']);
    Route::put('/notes/{note}', [NoteController::class, 'update']);
    Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
});
