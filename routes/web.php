<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/lamaran', function () {
    return view('lamaran');
})->name('lamaran');

Route::get('/', function () {
    return view('lamaran');
});