<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SB Admin 2 - Dashboard</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
</head>
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
                <div class="container my-5">
                    
                    <h1 class="h3 mb-4 text-gray-800">Add New Member</h1>

                    <form id="employeeForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Employee Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter employee name" required>
                            <div class="invalid-feedback">Please enter a name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter employee email" required>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role:</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="">Select a Role</option>
                                <option value="0">SupperAdmin</option>
                                <option value="1">Admin</option>
                                <option value="2">Employee</option>
                            </select>
                            <div class="invalid-feedback">Please select a role.</div>
                        </div>

                        <div class="mb-3">
                            <label for="job_role" class="form-label">Job Role:</label>
                            <input type="text" class="form-control" id="job_role" name="job_role" placeholder="Enter job role" required>
                            <div class="invalid-feedback">Please enter a job role.</div>
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Position:</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Enter position" required>
                            <div class="invalid-feedback">Please enter a position.</div>
                        </div>

                        <div class="mb-3">
                            <label for="join_date" class="form-label">Join Date:</label>
                            <input type="date" class="form-control" id="join_date" name="join_date" required>
                            <div class="invalid-feedback">Please select a join date.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            <div class="invalid-feedback">Please enter a password.</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <div id="response" class="mt-3"></div>

                    <div id="response" class="mt-3"></div>
                </div>
<!-- /.container-fluid -->

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

    <!-- Bootstrap validation -->
    <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                const forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <!-- Jquery function for submit form -->
    <script>
        $(document).ready(function() {
        // Set CSRF token for all Ajax requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fetch clients and populate the dropdown
        $.ajax({
            url: '/api/clients', // Backend route to fetch clients
            method: 'GET',
            success: function(data) {
                const clientDropdown = $('#client');
                clientDropdown.empty(); // Clear any existing options
                
                // Add a default placeholder option
                clientDropdown.append('<option value="">Select a Client</option>');
                
                // Populate dropdown with clients
                data.forEach(function(client) {
                    clientDropdown.append(`<option value="${client.id}">${client.name}</option>`);
                });
            },
            error: function(xhr) {
                console.error('Error fetching clients:', xhr);
            }
        });

        // Handle form submission
        $('#projectForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            // Send Ajax POST request
            $.ajax({
                url: '/project', // The route defined in your Laravel app
                method: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    $('#response').html('<p style="color:green;">Project added successfully!</p>');
                },
                error: function(xhr) {
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
