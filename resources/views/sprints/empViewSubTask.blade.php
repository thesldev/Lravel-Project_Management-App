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
                        <h1 class="h3 mb-2 text-gray-800">Sub-Tasks in Sprint #{{ $sprint->id }}</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Project: {{ $sprint->project->name }} | Sprint: {{ $sprint->title }}</h6>
                        </div>
                        <div class="card-body">
                            <p>Sprint Description: {{ $sprint->description }}</p>
                            <p style="display: flex;">
                                <span style="margin-right: 10px;">Start Date: {{ \Carbon\Carbon::parse($sprint->start_date)->format('Y-m-d') }}</span>
                                <span style="margin-right: 10px;"> | </span>
                                <span>End Date: {{ \Carbon\Carbon::parse($sprint->end_date)->format('Y-m-d') }}</span>
                            </p>
                            <div class="mt-5">
                                <p>Sub-Tasks Allocated To You:</p>
                                @if($subtasks->isEmpty())
                                    <p>No sub-tasks assigned to you in this sprint.</p>
                                @else
                                    <ul class="list-group">
                                        @foreach($subtasks as $subtask)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong>{{ $subtask->title }}</strong>
                                                
                                                <span class="badge 
                                                    @if($subtask->status == 'To Do') 
                                                        bg-secondary 
                                                    @elseif($subtask->status == 'In Progress') 
                                                        bg-warning 
                                                    @elseif($subtask->status == 'Completed') 
                                                        bg-success 
                                                    @endif">
                                                    {{ $subtask->status }}
                                                </span>

                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <button class="dropdown-item view-subtask" 
                                                                    data-url="{{ route('subtask.show', ['subtask' => $subtask->id]) }}">
                                                                View
                                                            </button>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Change</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
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

    <!-- popup for display sub-task -->
    <div class="modal fade" id="subtaskModal" tabindex="-1" aria-labelledby="subtaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subtaskModalLabel">Subtask Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Issue ID: </strong>#<span id="subtask-issue-id"></span></p>
                    <p><strong>Title:</strong> <span id="subtask-title"></span></p>
                    <p><strong>Description:</strong> <span id="subtask-description"></span></p>
                    <p><strong>Assignee ID:</strong> <span id="subtask-assignee-id"></span></p>
                    <p><strong>Status:</strong> <span id="subtask-status"></span></p>
                    <p><strong>Created By:</strong> <span id="subtask-created-by"></span></p>
                    <p><strong>Created At:</strong> <span id="subtask-created-at"></span></p>
                    <p><strong>Updated At:</strong> <span id="subtask-updated-at"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


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
    </script>

    <!-- Ajax & Jquery function for display selected subtask -->
    <script>
        $(document).ready(function () {
            $('.view-subtask').on('click', function () {
                var url = $(this).data('url'); // Get the URL from the button's data attribute

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        // Handle null or missing values and access nested properties
                        $('#subtask-issue-id').text(data.id ?? 'N/A');
                        $('#subtask-title').text(data.title ?? 'N/A');
                        $('#subtask-description').text(data.description ?? 'N/A');
                        $('#subtask-assignee-id').text(data.assignee?.name ?? 'N/A'); // Access assignee name
                        $('#subtask-status').text(data.status ?? 'N/A');
                        $('#subtask-created-by').text(data.created_by?.name ?? 'N/A'); // Access created_by name
                        $('#subtask-created-at').text(data.created_at ?? 'N/A');
                        $('#subtask-updated-at').text(data.updated_at ?? 'N/A');

                        // Show the modal
                        $('#subtaskModal').modal('show');
                    },

                    error: function () {
                        alert('Failed to fetch subtask details. Please try again.');
                    }
                });
            });
        });
    </script>


</body>

</html>
