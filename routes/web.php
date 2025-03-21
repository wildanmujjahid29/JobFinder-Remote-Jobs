<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// Halaman Utama
Route::get('/', [JobController::class, 'index'])->name('index');

// Rute untuk Chat 
Route::get('/chat', [ChatController::class, 'index']);
Route::post('/send-message', [ChatController::class, 'sendMessage']);
Route::get('/test-jobs-api', [ChatController::class, 'testJobsApi']);

// Rute untuk cek data yang mau di ambil
Route::get('/jobtype', [JobController::class, 'jobtype']);
Route::get('/jobindustry', [JobController::class, 'jobindustry']);
Route::get('/logo', [JobController::class, 'logo']);

// Rute Detail Pekerjaan (Hanya untuk Pengguna yang Login)
Route::get('/job/{id}', [JobController::class, 'show'])->name('job.detail')->middleware('auth');

// Autentikasi (Login, Register, Logout, dll.)
Auth::routes();

// Halaman Dashboard/Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route Untuk Profile User
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'userProfile'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('update');
});