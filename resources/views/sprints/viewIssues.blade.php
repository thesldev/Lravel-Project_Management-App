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
    <link href="{{ asset('css/subtask.css') }}" rel="stylesheet" />

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
                            <ul id="subtask-list"></ul>
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

    <!-- scripts for handle sub tasks -->
    <script>
        // display subtasks related to the issue
        $(document).ready(function () {
            let issueId = JSON.parse('@json($issue->id)');

            $.ajax({
                url: "{{ route('subtask.getAll') }}",
                method: 'GET',
                data: { issue_id: issueId },
                success: function (response) {
                    let subtaskList = $('#subtask-list');
                    subtaskList.empty();

                    if (response.length === 0) {
                        subtaskList.append('<div class="text-muted">No subtasks found.</div>');
                    } else {
                        response.forEach(function (subtask) {
                            let tags = Array.isArray(subtask.tags) ? subtask.tags : [];
                            let assigneeName = subtask.assignee ? subtask.assignee.name : 'Unassigned';
                            let assigneeId = subtask.assignee ? subtask.assignee.id : 'N/A';
                            let jobRole = subtask.assignee ? subtask.assignee.job_role : 'N/A';

                            let statusClass = '';
                            switch (subtask.status) {
                                case 'To Do':
                                    statusClass = 'bg-secondary';
                                    break;
                                case 'In Progress':
                                    statusClass = 'bg-warning';
                                    break;
                                case 'Completed':
                                    statusClass = 'bg-success';
                                    break;
                                default:
                                    statusClass = 'bg-primary';
                            }
                            let statusTag = subtask.status ? `<span class="badge ${statusClass} fs-14 mt-1">${subtask.status}</span>` : '';
                            if (statusTag) {
                                tags.push(statusTag);
                            }

                            let subtaskHTML = `
                                <div class="candidate-list-box card mt-4">
                                    <div class="p-4 card-body">
                                        <div class="align-items-center row">
                                            <div class="col-auto">
                                                <div class="candidate-list-images">
                                                    <a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-md img-thumbnail rounded-circle" /></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="candidate-list-content mt-3 mt-lg-0">
                                                    <h5 class="fs-19 mb-0">
                                                        <a class="primary-link" href="#">${subtask.title}</a><span class="badge bg-success ms-1"><i class="mdi mdi-star align-middle"></i>${subtask.priority || 'N/A'}</span>
                                                    </h5>
                                                    <p>${jobRole}</p>
                                                    <ul class="list-inline mb-0 text-muted">
                                                        <li class="list-inline-item"><i class="mdi mdi-calendar"></i> ${subtask.title || 'No title available'}</li>
                                                        <li class="list-inline-item"><i class="mdi mdi-account"></i> ${assigneeName}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                                    status: ${tags.map(tag => tag).join('')}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="favorite-icon">
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton${subtask.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical fs-18"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${subtask.id}">
                                                    <li>
                                                        <button class="dropdown-item btn-view" data-id="${subtask.id}" onclick="window.location.href='/subtasks/${subtask.id}/view'">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="ms-2">View</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item btn-remove" data-id="${subtask.id}">
                                                            <i class="bi bi-trash-fill"></i>
                                                            <span class="ms-2">Remove</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;

                            subtaskList.append(subtaskHTML);
                        });

                        // Rebind the click event for remove buttons
                        $('.btn-remove').off('click').on('click', function () {
                            let subtaskId = $(this).data('id');
                            if (confirm('Are you sure you want to remove this subtask?')) {
                                $.ajax({
                                    url: `/subtasks/${subtaskId}/delete`,
                                    method: 'POST',
                                    data: { _method: 'DELETE', _token: '{{ csrf_token() }}' }, // Ensure CSRF token is included
                                    success: function (response) {
                                        alert('Subtask removed successfully');
                                        location.reload(); // Refresh to show changes
                                    },
                                    error: function (error) {
                                        console.error('Error removing subtask:', error);
                                        alert('Failed to remove subtask');
                                    }
                                });
                            }
                        });
                    }
                },
                error: function (error) {
                    console.error('Error fetching subtasks:', error);
                }
            });
        });
    </script>

</body>

</html>
