<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SB Admin 2 - Dashboard</title>

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Include Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
     <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

</head>

<body id="page-top">

<div id="wrapper">

<!-- Include Sidebar -->
<x-side-bar />

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <x-topbar />
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Issue #{{ $issue->id }} | Project: {{ $issue->project->name }}</h1>

            <p class="mb-4">{{ $issue->description }}</p>

            <!-- selected issues in sprint -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Issue In: {{ $issue->sprint->title }} | Priority: {{ $issue->priority }}</h6>
                    <div class="ms-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubtaskModal" id="addSubtaskButton">
                        <i class="bi bi-person-fill-gear  mr-2"></i>
                        Add Subtask
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="card-body">
                            <!-- Display Issue Title, Status, and Priority inline -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p><strong>Issue Title:</strong> {{ $issue->title }}</p>
                                <!-- Issue Status with color badge -->
                                <p class="text-center">
                                    <strong>Issue Status:</strong>
                                    <span class="badge {{ 
                                        ($issue->status === 'Low') ? 'bg-success' : 
                                        (($issue->status === 'Medium') ? 'bg-warning' : 
                                        (($issue->status === 'High') ? 'bg-danger' : 
                                        (($issue->status === 'Critical') ? 'bg-dark' : 'bg-secondary'))) 
                                    }}">
                                        {{ $issue->status }}
                                    </span>
                                </p>
                                <!-- Priority with color badge -->
                                <p class="text-end">
                                    <strong>Priority:</strong>
                                    <span class="badge {{ 
                                        ($issue->priority === 'Low') ? 'bg-success' : 
                                        (($issue->priority === 'Medium') ? 'bg-warning' : 
                                        (($issue->priority === 'High') ? 'bg-danger' : 
                                        (($issue->priority === 'Critical') ? 'bg-dark' : 'bg-secondary'))) 
                                    }}">
                                        {{ $issue->priority }}
                                    </span>
                                </p>
                            </div>
                            <!-- Display Created By and Created At with left and right alignment -->
                            <div class="d-flex justify-content-start mb-3">
                                <p class="me-4"><strong>Created By:</strong> {{ $issue->sprint->createdBy->name }}</p>
                                <p class="me-4">|</p>
                                <p class="text-end"><strong>Created At:</strong> {{ $issue->created_at }}</p>
                            </div>

                            <!-- Display Project Details one after the other -->
                            <p><strong>Project Name:</strong> {{ $issue->project->name }}</p>
                            <p><strong>Project Type:</strong> {{ $issue->project->project_type }}</p>
                            <div class="d-flex justify-content-between">
                                <p><strong>Project Priority:</strong> {{ $issue->project->priority }}</p>
                                <p><strong>Project Deadline:</strong> {{ $issue->project->end_date }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- display project sub tasks -->
            <h1 class="h3 mb-2 text-gray-800 mt-5">Issue #{{ $issue->id }} | Sub Tasks</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Sub Tasks In: {{ $issue->title }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="card-body">
                            @if (isset($subtasks) && $subtasks->isNotEmpty())
                                <ul class="list-group">
                                    @foreach ($subtasks as $subtask)
                                        <li class="list-group-item">
                                            <strong>{{ $subtask->title }}</strong><br>
                                            <small>{{ $subtask->description }}</small><br>
                                            <span class="badge bg-info">{{ $subtask->status }}</span>
                                            <span class="badge bg-secondary">Assigned to: {{ $subtask->assignee->name ?? 'N/A' }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No subtasks available for this issue.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <x-footer />
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
    <!-- End of Wrapper -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal for Adding Subtask -->
    <div class="modal fade" id="addSubtaskModal" tabindex="-1" aria-labelledby="addSubtaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubtaskModalLabel">Add New Subtask</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Subtask Form -->
                    <form action="{{ route('subtasks.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Subtask Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="assignee" class="form-label">Assign Employee</label>
                            <select class="form-select" id="assignee" name="assignee_id" required>
                                <option value="">Select an Employee</option>
                                @if(isset($employees) && $employees->isNotEmpty())
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">No employees available</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="To Do">To Do</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="created_by" class="form-label">Created By</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="created_by" 
                                name="created_by" 
                                value="{{ auth()->user()->name ?? 'Unknown User' }}" 
                                readonly
                            >
                        </div>
                        <input type="hidden" name="created_by_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="issue_id" value="{{ $issue->id }}">
                        <button type="submit" class="btn btn-primary">Add Subtask</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- jQuery (necessary for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
