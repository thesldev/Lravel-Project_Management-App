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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

     <!-- Custom styles for this template-->
     <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Include Sidebar -->
        <x-employee-side-bar />

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Current Sprints</h1>
                    </div>

                    @foreach($projects as $project)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Project: {{ $project->name }}</h6>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <button class="dropdown-item btn-view" onclick="window.location.href='/projects/{{ $project->id }}/view'">
                                                <i class="bi bi-eye"></i>
                                                <span class="ms-2">View Project</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item btn-my-tasks">
                                                <i class="bi bi-list-task"></i>
                                                <span class="ms-2">My Tasks</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Description: {{ $project->description }}</p>
                                <p>Status: {{ $project->status }}</p>
                                <p>Start Date: {{ $project->start_date }}</p>
                                <p>End Date: {{ $project->end_date }}</p>

                                @php
                                    // Filter sprints for the current project
                                    $projectSprints = $sprints->where('project_id', $project->id);
                                @endphp

                                @if($projectSprints->isEmpty())
                                    <p>No sprints available for this project.</p>
                                @else
                                <ul class="list-group">
                                    @foreach($projectSprints as $sprint)
                                        @php
                                            // Count subtasks for this sprint assigned to the logged-in employee
                                            $sprintSubtasks = $subtasks->filter(function ($subtask) use ($sprint) {
                                                return $subtask->issue && $subtask->issue->sprint_id === $sprint->id;
                                            });
                                        @endphp
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                Sprint: {{ $sprint->title }} | 
                                                End Date: {{ \Carbon\Carbon::parse($sprint->end_date)->format('Y-m-d') }}
                                            </span>
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 me-2">For you: 
                                                    <span class="badge bg-primary">Total Sub-Tasks: {{ $sprintSubtasks->count() }}</span>
                                                </p>
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0" type="button" id="dropdownMenuButtonForYou" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonForYou">
                                                        <li>
                                                            <button class="dropdown-item btn-view" onclick="window.location.href='/sub-tasks/{{ $sprint->id }}/view'">
                                                                <i class="bi bi-eye"></i>
                                                                <span class="ms-2">View</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
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

        $(document).ready(function() {
            $('.btn-my-tasks').on('click', function() {
                var sprintId = $(this).closest('li').data('sprint-id'); // assuming you have a way to store or retrieve the sprint ID
                window.location.href = `/sprint-history/${sprintId}/view`;
            });
        });

    </script>

</body>

</html>
