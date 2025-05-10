<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    // Removed the user's create/store routes for cars

    Route::get('/bookings/create/{car_id}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/success', function () {
        return view('bookings.success');
    })->name('bookings.success');

    Route::get('/profile/history', [ProfileController::class, 'history'])->name('profile.history');
    Route::post('/bookings/{booking}/request-cancellation', [BookingController::class, 'requestCancellation'])->name('bookings.request-cancellation');
    Route::get('/profile/pending-cancellations', [ProfileController::class, 'pendingCancellations'])->name('profile.pending-cancellations');
    Route::get('/profile/history', [ProfileController::class, 'history'])->name('profile.history');
});

Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin car management routes
    Route::get('/cars/create', [CarController::class, 'adminCreate'])->name('admin.cars.create');
    Route::post('/cars', [CarController::class, 'adminStore'])->name('admin.cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'adminEdit'])->name('admin.cars.edit');
    Route::delete('/cars/{car}', [CarController::class, 'adminDestroy'])->name('admin.cars.destroy');
    Route::put('/cars/{car}', [CarController::class, 'adminUpdate'])->name('admin.cars.update');
    Route::get('/cars', [CarController::class, 'index'])->name('admin.cars.index');
    Route::post('/cars', [CarController::class, 'adminStore'])->name('admin.cars.store');
    Route::get('/bookings/pending', [BookingController::class, 'adminPendingBookings'])->name('admin.bookings.pending');
    Route::patch('/bookings/{booking}/approve', [BookingController::class, 'adminApproveBooking'])->name('admin.bookings.approve');
    Route::patch('/bookings/{booking}/reject', [BookingController::class, 'adminRejectBooking'])->name('admin.bookings.reject');
    Route::get('/bookings/history', [BookingController::class, 'adminBookingHistory'])->name('admin.bookings.history');
    Route::get('/cancellations/pending', [BookingController::class, 'adminPendingCancellations'])->name('admin.cancellations.pending');
    Route::patch('/cancellations/{booking}/approve', [BookingController::class, 'adminApproveCancellation'])->name('admin.cancellations.approve');
    Route::patch('/cancellations/{booking}/reject', [BookingController::class, 'adminRejectCancellation'])->name('admin.cancellations.reject');
});
