<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','rolemanager:employee'])->name('dashboard');


Route::get('/admin/dashboard', function () {
    return view('adminDashboard');
})->middleware(['auth', 'verified', 'rolemanager:admin'])->name('adminDashboard');


Route::get('/sup-admin/dashboard', function () {
    return view('superAdmindashboard');
})->middleware(['auth', 'verified', 'rolemanager:supperAdmin'])->name('supAdminDashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
