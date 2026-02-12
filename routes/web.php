<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RukunController;
use App\Http\Controllers\DashboardController;

//guest route
Route::middleware('guest.check')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.post');
    Route::get('/register', fn() => view('auth.register'))->name('register');
});

//harus login
Route::middleware(['auth.check'])->group(function () {

    //dashboard admin
    Route::middleware(['role.admin'])->group(function () {
        Route::get('/dashboard-admin', [DashboardController::class, 'admin'])->name('dashboard.admin');

        //users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        //rukun
        Route::get('/rukun', [RukunController::class, 'index'])->name('rukun.index');
        Route::post('/rukun', [RukunController::class, 'store'])->name('rukun.store');
        Route::get('/rukun/{id}', [RukunController::class, 'show'])->name('rukun.show');
        Route::put('/rukun/{id}', [RukunController::class, 'update'])->name('rukun.update');
        Route::delete('/rukun/{id}', [RukunController::class, 'destroy'])->name('rukun.destroy');
    });

    //dashboard lurah
    Route::middleware(['role.lurah'])->group(function () {
        Route::get('/dashboard-lurah', [DashboardController::class, 'lurah'])->name('dashboard.lurah');
    });

    //dashboard sekre
    Route::middleware(['role.sekre'])->group(function () {
        Route::get('/dashboard-sekre', [DashboardController::class, 'sekre'])->name('dashboard.sekre');
    });

    //dashboard staff
    Route::middleware(['role.staff'])->group(function () {
        Route::get('/dashboard-staff', [DashboardController::class, 'staff'])->name('dashboard.staff');
    });

    Route::get('/lamaran', fn() => view('pages.lamaran'))->name('lamaran');
    Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');
});

Route::get('/', function () {
    if (!session('token')) {
        return redirect()->route('login');
    }

    $user = session('user');
    return match ($user->jabatan->slug) {
        'administrator'   => redirect()->route('dashboard.admin'),
        'kepala_lurah'    => redirect()->route('dashboard.lurah'),
        'sekre_lurah'     => redirect()->route('dashboard.sekre'),
        'staff_pelayanan' => redirect()->route('dashboard.staff'),
        default           => redirect()->route('login')
    };
});
