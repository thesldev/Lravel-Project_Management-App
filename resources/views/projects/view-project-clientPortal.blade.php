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
        <x-client-side-bar />

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <x-topbar />
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Project #{{$project->id}} - Details</h1>

                    <!-- firest-section -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Project Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Project Name:</strong> {{ $project->name }}</p>
                                    <p><strong>Client Name:</strong> {{ $project->client->name }}</p>
                                    <p><strong>Project Type:</strong> {{ $project->project_type }}</p>
                                    <p><strong>Total Budget:</strong> {{ $project->budget }} $</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Description:</strong> {{ $project->description }}</p>
                                    <p>
                                        <strong>Project Status:</strong> 
                                        <span 
                                            class="badge 
                                                {{ $project->status === 'Pending' ? 'bg-warning text-dark' : '' }}
                                                {{ $project->status === 'Ongoing' ? 'bg-primary' : '' }}
                                                {{ $project->status === 'Completed' ? 'bg-success' : '' }}
                                                {{ $project->status === 'Delivered' ? 'bg-info text-dark' : '' }}"
                                        >
                                            {{ $project->status }}
                                        </span>
                                    </p>
                                    <p><strong>Project Start Date:</strong> {{ $project->start_date }}</p>
                                    <p><strong>Project End Date:</strong> {{ $project->end_date }}</p>
                                </div>
                            </div>
                        </div>
  
                        <!-- Extended Deadline -->
                        <hr>
                        <div class="card-body">
                            <h5 class="font-weight-bold text-primary">Extended Deadlines</h5>
                            @if($project->extended_deadline)
                                <p><strong>Extended Deadline:</strong> {{ $project->extended_deadline }}</p>
                            @else
                                <p>No extended deadline set for this project.</p>
                            @endif
                         </div>                       
                    </div>

                    <!-- second-section -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Support Tickets</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
              
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

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Ajax and Jquery functions for handle update form -->
    <!-- <script>
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
    </script> -->

    <!-- Ajax and Jquery functions for handle manage function -->
    <!-- <script>
        function openManageProjectModal(projectId) {
        // Set project ID in the modal's hidden field
        $('#project_id').val(projectId);

        // Clear response message
        $('#responseMessage').html('');

        // Fetch existing data for this project via AJAX
        $.ajax({
            url: `/projects/${projectId}/manage-data`,
            method: 'GET',
            success: function (data) {
                // Populate employee list
                let employeeOptions = '';
                data.employees.forEach(employee => {
                    const selected = data.assignedEmployees.includes(employee.id) ? 'selected' : '';
                    employeeOptions += `<option value="${employee.id}" ${selected}>${employee.name}</option>`;
                });
                $('#employees').html(employeeOptions);

                // Set priority
                $('#priority').val(data.priority);

                // Set deadline
                $('#end_date').val(data.end_date);
            },
            error: function () {
                alert('Failed to load project data.');
            }
        });

        // Open the modal
        $('#manageProjectModal').modal('show');
    }

        $('#manageProjectForm').on('submit', function (e) {
        e.preventDefault();

        const projectId = $('#project_id').val();
        const formData = $(this).serialize(); // This should automatically handle the 'employees[]' field

        console.log('Form Data:', formData);

        $.ajax({
            url: `/projects/${projectId}/manage`,
            method: 'POST',
            data: formData,
            success: function (response) {
                $('#responseMessage').html('<p class="text-success">Project updated successfully!</p>');
                setTimeout(() => $('#manageProjectModal').modal('hide'), 1500);
            },
            error: function (xhr) {
                $('#responseMessage').html(`<p class="text-danger">Error: ${xhr.responseText}</p>`);
            }
        });
    });


    </script> -->

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