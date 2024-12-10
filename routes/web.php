<?php

use App\Http\Controllers\BackLogController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IssuesInSprint;
use App\Http\Controllers\IssuesInSprintController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketStatusController;
use App\Http\Controllers\TicketTypeController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employee-dashboard', [TemplateController::class, 'employeeDashboard'])
    ->middleware(['auth', 'verified', 'rolemanager:employee'])
    ->name('employeeDashboard');


Route::get('/admin-dashboard', [TemplateController::class, 'admin'])
    ->middleware(['auth', 'verified', 'rolemanager:admin'])
    ->name('admin');


Route::get('/sup-admin-dashboard', [TemplateController::class, 'supAdmin'])
    ->middleware(['auth', 'verified', 'rolemanager:admin'])
    ->name('supAdmin');


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
    ->middleware(['auth','verified','rolemanager:supperAdmin'])
    ->name('client.editData');

// create route for edit existing client data 
Route::put('/client/{client}/update', [ClientController::class, 'updateData'])
    ->middleware(['auth','verified', 'rolemanager:supperAdmin'])
    ->name('client.updateData');

//create route for delete client data
Route::delete('/client/{client}/destroy', [ClientController::class, 'deleteData'])
    ->middleware('auth','verified','rolemanager:supperAdmin')
    ->name('client.deleteData');

// route for grt client data in JSON format
Route::get('/api/clients', [ClientController::class, 'getClients'])
    ->middleware(['auth','verified','rolemanager:supperAdmin,admin'])
    ->name('clients.getClients');


// routes for handel projects data

// route for get project data page
Route::get('/projects', [ProjectController::class, 'index'])
    ->middleware(['auth','verified'])
    ->name('projects.index');

// create route for "add project" page
Route::get('/projects/new-project', [ProjectController::class, 'create'])
    ->middleware('auth','verified','rolemanager:supperAdmin,admin')
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

// route for manage project
Route::get('/projects/{project}/manage-data', [ProjectController::class, 'manageData'])
    ->middleware(['auth', 'verified', 'rolemanager:supperAdmin,admin'])
    ->name('project.manageData');

// route for handle manage form submission
Route::post('/projects/{project}/manage', [ProjectController::class, 'updateManageData'])
    ->middleware(['auth', 'verified', 'rolemanager:admin,supperAdmin'])
    ->name('project.updateManageData');

// fetch project data
Route::get('/api/projects', [ProjectController::class, 'getProjects']);


// routes for handle employee data

// create route for get employee data page
Route::get('/employees', [EmployeeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('employee.index');

// create route for "add employee" page
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

//  fetch employee data
Route::get('/api/employees', [EmployeeController::class, 'getEmployees']);



// routes for manage ticketing system

// routr for manage board  
Route::get('/boards', [BoardController::class, 'index'])
    ->middleware('auth','verified', 'rolemanager:supperAdmin, admin')
    ->name('board.index');

// routes for go to tiklets page
Route::get('/tickets', [TicketController::class, 'index'])
    ->middleware('auth','verified', 'rolemanager:supperAdmin, admin')
    ->name('ticket.index');



// route for go to types page
Route::get('/ticket-types', [TicketTypeController::class, 'index'])
    ->middleware('auth','verified', 'rolemanager:supperAdmin, admin')
    ->name('type.index');

// rote for sore ticket type
Route::post('/ticket-types', [TicketTypeController::class, 'store'])
    ->middleware('auth','verified','rolemanager:supperAdmin, admin')
    ->name('type.store');

// route for get ticket types
Route::get('/ticket-type', [TicketTypeController::class, 'getType'])
    ->middleware('auth','verified','rolemanager:supperAdmin, admin')
    ->name('type.getType');

// Route for updating ticket type
Route::put('/ticket-types/{ticketType}', [TicketTypeController::class, 'update'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('type.update');

// Route for deleting ticket type
Route::delete('/ticket-types/{ticketType}', [TicketTypeController::class, 'destroy'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('type.destroy');

// Route for fetching ticket types
Route::get('/api/ticketType', [TicketTypeController::class, 'getTicketType']);


// route for go to add status page
Route::get('/status', [TicketStatusController::class, 'status'])
    ->middleware('auth','verified', 'rolemanager:supperAdmin, admin')
    ->name('status.status');


// route for create status
Route::post('/ticket-status', [TicketStatusController::class, 'store'])
    ->middleware('auth','verified', 'rolemanager:supperAdmin, admin')
    ->name('status.store');

// route for get all statuses
Route::get('/ticket-statuses', [TicketStatusController::class, 'get'])
    ->middleware('auth','verified', 'rolemanager:supperAdmin, admin')
    ->name('status.get');

// Delete route for ticket status
Route::delete('/ticket-status/{ticketStatus}', [TicketStatusController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'rolemanager:supperAdmin, admin'])
    ->name('status.destroy');

// update route for ticket status
Route::put('/ticket-statuses/{id}', [TicketStatusController::class,'update'])
    ->middleware(['auth', 'verified', 'rolemanager:supperAdmin, admin'])
    ->name('status.update');

// Route for fetching ticket statuses
Route::get('/api/ticketStatuses', [TicketStatusController::class, 'getTicketStatuses']);




// route for create function for ticket
Route::post('/tickets/create-ticket', [TicketController::class, 'store'])
    ->middleware('auth','verified', 'rolemanager:supperAdmin, admin')
    ->name('ticket.store');

// route fot gey all ticket data
Route::get('/tickets/all', [TicketController::class, 'getTickets'])
    ->middleware('auth','verified','rolemanager:supperAdmin, admin')
    ->name(('ticket.getProjects'));

// view selected ticket
Route::get('/tickets/{ticket}/view', [TicketController::class, 'view'])
    ->middleware('auth','verified', 'rolemanager:supperAdmin, admin')
    ->name('ticket.view');

// route for edit ticket details
Route::put('/tickets/{ticket}/update', [TicketController::class, 'update'])
    ->middleware('auth','verified','rolemanager:supperAdmin')
    ->name('tickets.update');

// route for delete ticketdetails
Route::delete('/tickets/{ticket}/delete', [TicketController::class, 'destroy']) 
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('ticket.destroy');

// change the ticket status, both employee & admins
Route::get('/tickets/{ticket}/change-status', [TicketController::class, 'changeStatus'])
    ->middleware('auth', 'verified', 'rolemanager:employee, supperAdmin, admin')
    ->name('ticket.changeStatus');

// update ticket status
Route::put('/tickets/{ticket}/update-status', [TicketController::class, 'updateStatus'])
    ->middleware('auth', 'verified', 'rolemanager:employee')
    ->name('ticket.updateStatus');


// ticket's routes for employees

//  route for display ticket by user ID
Route::get('/my-tickets', [TicketController::class, 'empTickets'])
    ->middleware('auth', 'verified', 'rolemanager:employee')
    ->name('ticket.empTickets');

// view selected ticket
Route::get('/tickets/{ticket}/emp-view', [TicketController::class, 'empView'])
    ->middleware('auth', 'verified', 'rolemanager:employee')
    ->name('ticket.empView');

// create comments for tickets, from employee side
Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store'])
    ->middleware('auth', 'verified', 'rolemanager:employee')
    ->name('comments.store');

// create comments for tickets, from admin side
Route::post('/tickets/{ticket}/adminComments', [CommentController::class, 'storeAdmin'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('comments.storeAdmin');

// route for get all comments related to the ticket
Route::get('/tickets/{ticket}/comments', [CommentController::class, 'getComments'])
    ->middleware('auth', 'verified', 'rolemanager:employee')
    ->name('comments.getComments');

// route for get all comments related to the ticket (admin)
Route::get('/tickets/{ticket}/adminComments', [CommentController::class, 'getAdminComments'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('comments.getAdminComments');

// route for delete the comments-employee side
// In routes/web.php or routes/api.php
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])
    ->middleware('auth', 'verified')
    ->name('comments.destroy');

// In routes/web.php or routes/api.php
Route::put('/comments/{id}', [CommentController::class, 'update'])
    ->middleware('auth', 'verified')
    ->name('comments.update');




// routes for handle claender functions
Route::get('/calendar', [ScheduleController::class, 'index'])
    ->middleware('auth', 'verified')
    ->name('calender.index');

// route for create event
Route::post('/add-event', [ScheduleController::class, 'store'])
    ->middleware('auth', 'verified')
    ->name('calender.store');

// route for get the events
Route::get('/events', [ScheduleController::class, 'getEvents'])
    ->middleware('auth', 'verified')
    ->name('calender.getEvents');

// route for update the event
Route::post('/schedule/{eventId}', [ScheduleController::class, 'update'])
    ->middleware('auth', 'verified')
    ->name('calender.update');

// route for delete the event
Route::delete('/events/{id}', [ScheduleController::class, 'deleteEvent'])
    ->middleware('auth', 'verified')
    ->name('calender.deleteEvent');

// route for get selected event data
Route::get('/event/{id}', [ScheduleController::class, 'show'])
    ->middleware('auth', 'verified')
    ->name('event.show');

// route for resize the devent duration
Route::post('/schedule/{id}/resize', [ScheduleController::class, 'resize'])
    ->middleware('auth', 'verified')
    ->name('calender.resize');

// route for search events
Route::get('/events/search', [ScheduleController::class, 'search'])
    ->middleware('auth', 'verified')
    ->name('calender.search');

// routes for handle sprints

// rout for go to create new sprint 
Route::get('/sprints', [SprintController::class, 'index'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('sprint.index');

//  route for go to manage sprits page
Route::get('/manage-sprints', [SprintController::class, 'managePage'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('sprint.managePage');

// route for go to manage selected sprint page
Route::get('/sprints/{id}/view', [SprintController::class, 'manage'])
    ->middleware(['auth', 'verified', 'rolemanager:supperAdmin,admin'])
    ->name('sprint.manage');

// route for store sprint data
Route::post('/sprints/new', [SprintController::class, 'store'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('sprint.store');

// route for create backlog issue
Route::post('/issue/create', [BackLogController::class, 'store'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('backlog.store');

// route for fetch data to update issues
Route::get('/issues/{id}', [BackLogController::class, 'show'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('issues.show');

// Route to update issue details by ID
Route::put('/issues/{id}', [BackLogController::class, 'update'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('issues.update');

// route for delete function in project
// Route to handle the deletion of an issue
Route::delete('/issues/{issue}', [BackLogController::class, 'destroy'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('issues.destroy');


// route for get issues
Route::get('/issues', [BackLogController::class, 'getIssues'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('backlog.getIssues');

// route for get issues in sprint
Route::get('/issues-in-sprint', [IssuesInSprintController::class, 'getIssues'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('issuesInSprint.getIssues');

// In your web.php or api.php routes file
Route::post('/issues-in-sprint/update-order', [IssuesInSprintController::class, 'updateOrder'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('issuesInSprint.updateOrder');

// route for update the order list
Route::post('/backlog/update-order', [BacklogController::class, 'updateOrder'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('backlog.updateOrder');

// route for drag & drop issues into sprint..
Route::post('/issues-in-sprint/store', [IssuesInSprintController::class, 'store'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('issuesInSprint.store');

// route for remove issue from the sprint
Route::delete('/issues-in-sprint/{issueId}', [IssuesInSprintController::class, 'destroy'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('issuesInSprint.destroy');


// route for go to view issue page...
Route::get('/issues/{id}/viewIssue', [BacklogController::class, 'view'])
    ->middleware(['auth', 'verified', 'rolemanager:supperAdmin,admin'])
    ->name('issuesInSprint.view');

// route for create sub task
Route::post('/subtasks', [SubtaskController::class, 'store'])
    ->middleware(['auth', 'verified', 'rolemanager:supperAdmin,admin'])
    ->name('subtasks.store');

// route for display sub tasks according to the issue
Route::get('/issues/{issue_id}/subtasks', [SubtaskController::class, 'getSubtasksByIssue'])
    ->middleware(['auth', 'verified', 'rolemanager:supperAdmin,admin'])
    ->name('subtasks.byIssue');

// route display subtasks
Route::get('/subtask.getAll', [SubtaskController::class, 'getAll'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('subtask.getAll');

// route for remove sub tasks
Route::delete('/subtasks/{id}/delete', [SubtaskController::class, 'destroy'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('subtask.destroy');

// route for display selected subtask
Route::get('/subtasks/{subtask}', [SubtaskController::class, 'show'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin, admin')
    ->name('subtask.show');

// route for display subtasks in edit form
Route::get('/subtasks/{id}', [SubtaskController::class, 'edit'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin,admin')
    ->name('subtasks.edit');

// route for update selected subtask
Route::put('/subtasks/{id}', [SubtaskController::class, 'update'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin,admin')
    ->name('subtasks.update');

// route for display sprint's data for employee
Route::get('/emp-sprints', [SprintController::class, 'empView'])
    ->middleware('auth', 'verified', 'rolemanager:employee')
    ->name('sprint.empView');

// routes for handle sprint history
// go to sprint history page..
Route::get('/sprint-history', [SprintController::class, 'viewHistory'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin,admin')
    ->name('history.viewHistory');

// route for view project with sprint's data
Route::get('/sprints-history/{id}', [SprintController::class, 'projectHistory'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin,admin')
    ->name('history.projectHistory');



// routes for generate pdf files
Route::get('/projects/pdf', [ProjectController::class, 'generatePDF'])
    ->middleware('auth', 'verified', 'rolemanager:supperAdmin,admin')
    ->name('projects.pdf'); 


    
require __DIR__.'/auth.php';
