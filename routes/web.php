<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TemplateController;
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


// create rout for home & dashboard
Route::get('/home', [TemplateController::class, 'index'])
    ->middleware(['auth','verified','rolemanager:admin,supperAdmin,employee'])
    ->name('home.index');

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
    ->middleware(['auth', 'verified'])
    ->name('client.index');

// Route for fetching client data via Ajax
Route::get('/clients/fetch', [ClientController::class, 'fetchClients'])
    ->middleware(['auth', 'verified', 'rolemanager:employee,admin,supperAdmin'])
    ->name('clients.fetch');

// route for access create new client form
Route::get('/clients/add-client', [ClientController::class, 'create'])
    ->middleware(['auth', 'verified', 'rolemanager:admin,supperAdmin'])
    ->name('client.create');

// route for get client by id
Route::get('/clients/{client}/view', [ClientController::class, 'viewClient'])
    ->middleware(['auth','verified'])
    ->name('client.view');

// create route for fetch existing client data to edit
Route::get('/client/{client}/edit', [ClientController::class, 'editData'])
    ->middleware(['auth','verified','rolemanager:admin,supperAdmin'])
    ->name('client.editData');

// create route for edit existing client data 
Route::put('/client/{client}/update', [ClientController::class, 'updateData'])
    ->middleware(['auth','verified', 'rolemanager:admin,supperAdmin'])
    ->name('client.updateData');

//create route for delete client data
Route::delete('/client/{client}/destroy', [ClientController::class, 'deleteData'])
    ->middleware('auth','verified','rolemanager:admin,supperAdmin')
    ->name('client.deleteData');

// route for grt client data in JSON format
Route::get('/api/clients', [ClientController::class, 'getClients'])
    ->middleware(['auth','verified','rolemanager:admin,supperAdmin'])
    ->name('clients.getClients');


// routes for handel projects data

// route for get project data page
Route::get('/projects', [ProjectController::class, 'index'])
    ->middleware(['auth','verified'])
    ->name('projects.index');

// create route for "add client" page
Route::get('/projects/new-project', [ProjectController::class, 'create'])
    ->middleware('auth','verified','rolemanager:admin,supperAdmin')
    ->name('project.create');

// create route for add project to system
Route::post('/project', [ProjectController::class, 'store'])
    ->middleware('auth','verified','rolemanager:admin,supperAdmin')
    ->name('project.store');

// route for view selected project
Route::get('/projects/{project}/view', [ProjectController::class, 'viewProject'])
    ->middleware(['auth','verified'])
    ->name('project.viewProject');

// route for edit project details
Route::put('/projects/{project}/update', [ProjectController::class, 'update'])
    ->middleware('auth','verified','rolemanager:admin,supperAdmin')
    ->name('project.update');

// route for delete project
Route::delete('/projects/{project}/destroy', [ProjectController::class, 'destroy'])
    ->middleware('auth','verified','rolemanager:supperAdmin')
    ->name('project.destroy');



// routes for handle employee data


// create route for get employee data page
Route::get('/employees', [EmployeeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('employee.index');

// create route for "add client" page
Route::get('/employees/new-employee', [EmployeeController::class, 'create'])
    ->middleware('auth','verified','rolemanager:supperAdmin')
    ->name('employee.create');

// route for employee table create function
Route::post('/employee', [EmployeeController::class, 'store'])
    ->middleware(['auth', 'verified', 'rolemanager:supperAdmin'])
    ->name('employee.store');

// route for view selected employee
Route::get('/employee/{employee}/view', [EmployeeController::class, 'viewEmployee'])
    ->middleware(['auth','verified'])
    ->name('employee.viewEmployee');

// route for edit employee details
Route::put('/employees/{employee}/update', [EmployeeController::class, 'update'])
    ->middleware('auth','verified','rolemanager:supperAdmin')
    ->name('employee.update');

// route for remove employee
Route::delete('/employees/{employee}/destroy', [EmployeeController::class, 'destroy'])
    ->middleware('auth','verified','rolemanager:supperAdmin')
    ->name('employee.destroy');

require __DIR__.'/auth.php';
