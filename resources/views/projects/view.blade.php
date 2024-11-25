<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

    <!-- jQuery (necessary for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
                    <h1 class="h3 mb-4 text-gray-800">Project Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Project Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Project ID:</strong> {{ $project->id }}</p>
                            <p><strong>Project Name:</strong> {{ $project->name }}</p>
                            <p><strong>Client Name:</strong> {{ $project->client->name }}</p>
                            <p><strong>Project Type:</strong> {{ $project->project_type }}</p>
                            <p><strong>Description:</strong> {{ $project->description }}</p>
                            <p><strong>Project Status:</strong> {{ $project->status }}</p>
                            <p><strong>Project Start Date:</strong> {{ $project->start_date }}</p>
                            <p><strong>Project End Date:</strong> {{ $project->end_date }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div>
                        <!-- Edit Button -->
                        <a href="javascript:void(0);" id="editButton" class="btn btn-warning btn-icon-split" style="margin-right: 10px;">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Edit</span>
                        </a>


                        <!-- Delete Button -->
                        <form action="{{ route('project.destroy', $project->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Are you sure you want to delete this project?');">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Delete</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Project</h5>
                                <a href="{{ route('project.viewProject', ['project' => $project->id]) }}" class="btn-close" aria-label="Close"></a>
                            </div>
                            <form id="editForm" action="{{ route('project.update', ['project' => $project->id]) }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="editName" class="form-label">Project Name</label>
                                        <input type="text" class="form-control" id="editName" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editClient" class="form-label">Client</label>
                                        <select class="form-select" id="editClient" name="client_id" required>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editType" class="form-label">Project Type</label>
                                        <select class="form-select" id="editType" name="project_type" required>
                                            <option value="Web">Web</option>
                                            <option value="Mobile">Mobile</option>
                                            <option value="Desktop">Desktop</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editStatus" class="form-label">Status</label>
                                        <select class="form-select" id="editStatus" name="status" required>
                                            <option value="Pending">Pending</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editStartDate" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="editStartDate" name="start_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEndDate" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="editEndDate" name="end_date">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('project.viewProject', ['project' => $project->id]) }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
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

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Ajax and Jquery functions for handle update form -->
    <script>
        $(document).ready(function () {
            // Set CSRF token for all Ajax requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let projectId;

            // Open edit modal and populate fields
            $('#editButton').on('click', function () {
                projectId = "{{ $project->id }}"; // Ensure project ID is valid
                
                // Populate modal fields with project data
                $('#editName').val("{{ $project->name }}");
                $('#editDescription').val("{{ $project->description }}");
                $('#editClient').val("{{ $project->client_id }}");
                $('#editType').val("{{ $project->project_type }}");
                $('#editStatus').val("{{ $project->status }}");
                $('#editStartDate').val("{{ $project->start_date }}");
                $('#editEndDate').val("{{ $project->end_date }}");

                // Show modal
                $('#editModal').modal('show');
            });

            // Handle form submission
            $('#editForm').on('submit', function (event) {
                event.preventDefault(); // Prevent default form submission

                if (!projectId) {
                    alert('Project ID is missing. Please try again.');
                    return;
                }

                // Serialize form data
                const formData = $(this).serialize();

                // AJAX request to update project
                $.ajax({
                    url: `/projects/${projectId}/update`, // Adjust the route based on Laravel setup
                    method: 'PUT',
                    data: formData,
                    success: function (response) {
                        $('#response').html('<p style="color:green;">Project updated successfully!</p>');
                        location.reload(); // Reload to reflect changes
                    },
                    error: function (xhr) {
                        $('#response').html('<p style="color:red;">Error: ' + xhr.responseText + '</p>');
                    }
                });
            });
        });
    </script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

</body>
</html>