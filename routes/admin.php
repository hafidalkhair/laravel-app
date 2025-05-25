<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Services Management
Route::resource('services', ServiceController::class);

// Bookings Management
Route::resource('bookings', BookingController::class)->only(['index', 'show']);
Route::patch('bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.update-status');

// Users Management
Route::resource('users', UserController::class)->only(['index', 'show', 'destroy']);

// Gallery Management
Route::resource('galleries', GalleryController::class); 