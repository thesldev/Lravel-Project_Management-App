<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>All Sprints - Admin Dashboard</title>

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

     <!-- Custom styles for this template-->
     <link href="css/sb-admin-2.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="{{ asset('css/sprint_style.css') }}">
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">All Sprints</h1>
                        
                        <div class="ms-auto">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTicketModal">Create Sprint</button>
                        </div>
                    </div>

                    <!-- Active Sprints -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Sprints</h6>
                        </div>
                        <div class="card-body overflow-wrapper">
                            @foreach($sprints as $sprint)    
                                <div class="col-md-6 col-lg-12 mb-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body pt-3 pb-1">
                                            <h6 class="card-title">
                                                Project: <span class="fw-bold">{{ $sprint->project->name ?? 'N/A' }}</span>
                                                <span class="float-end">Duration: {{ $sprint->duration_weeks }} weeks</span>
                                            </h6>
                                        </div>
                                        <div class="card-body pt-1 pb-3">
                                            <h5 class="card-title">{{ $sprint->title }}</h5>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span><strong>Description:</strong> {{ $sprint->description }}</span>
                                            </div>
                                        </div>
                                        <div class="card-body pt-1 pb-3 start-end-dates">
                                            <div>Start Date: {{ $sprint->start_date }}</div>
                                            <div>End Date: {{ $sprint->end_date }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

    <!-- Create Sprint Modal -->
    <div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby="createSprintModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createSprintForm" action="{{ route('sprint.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSprintModalLabel">Create Sprint</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Sprint Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Sprint Name</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <!-- Sprint Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <!-- Project -->
                        <div class="mb-3">
                            <label for="project_id" class="form-label">Project</label>
                            <select class="form-select" id="project_id" name="project_id" required>
                                <!-- Populate projects dynamically -->
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Duration Weeks -->
                        <div class="mb-3">
                            <label for="duration_weeks" class="form-label">Duration (Weeks)</label>
                            <select class="form-select" id="duration_weeks" name="duration_weeks" required>
                                <option value="2">2 Weeks</option>
                                <option value="3">3 Weeks</option>
                                <option value="4">4 Weeks</option>
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <!-- End Date -->
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="created_by" class="form-label">Created By</label>
                            <input type="text" class="form-control" id="created_by" name="created_by" value="{{ auth()->user()->id }}" readonly>
                        </div>             
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Sprint</button>
                    </div>
                </form>
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


    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const startDateInput = document.getElementById('start_date');
            const durationInput = document.getElementById('duration_weeks');
            const endDateInput = document.getElementById('end_date');

            function calculateEndDate() {
                const startDateValue = startDateInput.value;
                const durationWeeks = parseInt(durationInput.value, 10);

                if (startDateValue && durationWeeks) {
                    const startDate = new Date(startDateValue);
                    const endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + (durationWeeks * 7)); // Add weeks in days
                    endDateInput.value = endDate.toISOString().split('T')[0]; // Format as yyyy-mm-dd
                } else {
                    endDateInput.value = ''; // Clear the end date if inputs are invalid
                }
            }

            startDateInput.addEventListener('change', calculateEndDate);
            durationInput.addEventListener('change', calculateEndDate);
        });
    </script>


</body>

</html>
