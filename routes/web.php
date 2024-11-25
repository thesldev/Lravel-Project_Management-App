<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','rolemanager:employee'])->name('dashboard');


Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:admin'])->name('adminDashboard');


Route::get('/sup-admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:supperAdmin'])->name('supAdminDashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// routes for handle client data

// route for client's create function 
Route::post('/clients', [ClientController::class, 'storeData'])
    ->middleware(['auth','verified','rolemanager:admin,supperAdmin'])
    ->name('client.storeData');

// create route for get client data page
Route::get('/clients', [ClientController::class, 'index'])
    ->middleware(['auth', 'verified', 'rolemanager:admin,supperAdmin,employee'])
    ->name('client.index');

// Route for fetching client data via Ajax
Route::get('/clients/fetch', [ClientController::class, 'fetchClients'])
    ->middleware(['auth', 'verified', 'rolemanager:admin,supperAdmin,employee'])
    ->name('clients.fetch');

// route for access create new client form
Route::get('/clients/add-client', [ClientController::class, 'create'])
    ->middleware(['auth', 'verified', 'rolemanager:admin,supperAdmin'])
    ->name('client.create');

// route for get client by id
Route::get('/clients/{client}/view', [ClientController::class, 'viewClient'])
    ->middleware(['auth','verified','rolemanager:admin,supperAdmin,employee'])
    ->name('client.view');

require __DIR__.'/auth.php';
