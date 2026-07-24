<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DocumentController as UserDocumentController;
use Illuminate\Support\Facades\Route;

// Setara dengan index.php: arahkan ke dashboard sesuai peran.
Route::get('/', HomeController::class)->middleware('auth')->name('home');

// ----- Auth (setara login.php, register.php, logout.php) -----
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ----- Area User (setara folder user/) -----
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDocumentController::class, 'index'])->name('dashboard');
    Route::get('/upload', [UserDocumentController::class, 'create'])->name('upload');
    Route::post('/upload', [UserDocumentController::class, 'store'])->name('upload.store');
    Route::get('/dokumen/{document}/ganti-file', [UserDocumentController::class, 'edit'])->name('document.edit');
    Route::post('/dokumen/{document}/ganti-file', [UserDocumentController::class, 'update'])->name('document.update');
});

// ----- Area Admin (setara folder admin/) -----
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/dokumen/{document}', [AdminDocumentController::class, 'show'])->name('document.show');
    Route::post('/dokumen/{document}/review', [AdminDocumentController::class, 'review'])->name('document.review');
    Route::post('/dokumen/{document}/direktur', [AdminDocumentController::class, 'director'])->name('document.director');
    Route::post('/dokumen/{document}/selesai', [AdminDocumentController::class, 'complete'])->name('document.complete');

    Route::get('/pengguna', [AdminUserController::class, 'index'])->name('users');
    Route::post('/pengguna', [AdminUserController::class, 'store'])->name('users.store');
});
