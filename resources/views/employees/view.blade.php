<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Manage Employee - Admin Dashboard</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Employee Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Employee Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Employee ID:</strong> {{ $employee->id }}</p>
                            <p><strong>Employee Name:</strong> {{ $employee->name }}</p>
                            <p><strong>Email:</strong> {{ $employee->email }}</p>
                            <p><strong>Worker - Role :</strong> 
                                @if ($employee->role == 0)
                                    Supper Admin
                                @elseif ($employee->role == 1)
                                    Admin
                                @else
                                    Employee
                                @endif
                            </p>
                            <p><strong>Job Role:</strong> {{ $employee->job_role }}</p>
                            <p><strong>Position:</strong> {{ $employee->position }}</p>
                            <p><strong>Start Date:</strong> {{ $employee->join_date }}</p>
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
                        <form action="{{ route('employee.destroy', $employee->id) }}"" method="POST" style="display:inline;">
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
                                <h5 class="modal-title" id="editModalLabel">Edit Client</h5>
                                <a href="{{ route('employee.viewEmployee', ['employee' => $employee->id]) }}" class="btn-close" aria-label="Close"></a>
                            </div>
                            <form id="editForm" action="{{ route('employee.update', ['employee' => $employee->id]) }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="editRole" class="form-label">Worker - Role</label>
                                        <select class="form-select" id="editRole" name="role" required>
                                            <option value="0" @if ($employee->role == 0) selected @endif>Super Admin</option>
                                            <option value="1" @if ($employee->role == 1) selected @endif>Admin</option>
                                            <option value="2" @if ($employee->role == 2) selected @endif>Employee</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editJobrole" class="form-label">Job Role</label>
                                        <textarea class="form-control" id="editJobrole" name="job_role">{{ $employee->job_role }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPosition" class="form-label">Position</label>
                                        <textarea class="form-control" id="editPosition" name="position">{{ $employee->position }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('employee.viewEmployee', ['employee' => $employee->id]) }}" class="btn btn-secondary">Cancel</a>
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

        let employeeId;

        // Open edit modal and populate fields
        $('#editButton').on('click', function () {
            employeeId = "{{ $employee->id }}"; // Ensure employee ID is valid
            
            // Populate modal fields with employee data
            $('#editRole').val("{{ $employee->role }}");
            $('#editJobrole').val("{{ $employee->job_role }}");
            $('#editPosition').val("{{ $employee->position }}");

            // Show modal
            $('#editModal').modal('show');
        });

        // Handle form submission
        $('#editForm').on('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            if (!employeeId) {
                alert('Employee ID is missing. Please try again.');
                return;
            }

            // Serialize form data
            const formData = $(this).serialize();

            // AJAX request to update employee
            $.ajax({
                url: `/employees/${employeeId}/update`,  // Ensure employeeId is properly set
                method: 'PUT',
                data: formData,  // Ensure formData is serialized correctly
                success: function (response) {
                    // Close the modal
                    $('#editModal').modal('hide');

                    // Optionally, show a success message
                    $('#response').html('<p style="color:green;">Employee updated successfully!</p>');

                    // Reload the page to reflect changes
                    location.reload();  // This will reload the current page
                },
                error: function (xhr) {
                    // Handle error
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