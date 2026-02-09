<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout'); // ← Tambah ini

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/lamaran', function () {
    return view('pages.lamaran');
})->name('lamaran');

Route::get('/', function () {
    return redirect()->route('login');
});