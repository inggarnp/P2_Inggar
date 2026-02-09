<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('guest.check')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.post');
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

Route::middleware(['auth.check'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
    
    Route::get('/lamaran', function () {
        return view('pages.lamaran');
    })->name('lamaran');
    
    Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');
});

Route::get('/', function () {
    if (session('token')) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});