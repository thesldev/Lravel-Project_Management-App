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
                <!-- Begin Page Content -->
                <div class="container my-5">
                    
                    <h1 class="h3 mb-4 text-gray-800">Add New Client</h1>

                    <form id="projectForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Project Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter project name" required>
                            <div class="invalid-feedback">Please enter a project name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter project description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="client" class="form-label">Client:</label>
                            <select id="client" name="client_id" class="form-select" required>
                                <option value="">Select a Client</option> <!-- Placeholder -->
                            </select>
                            <div class="invalid-feedback">Please select a client.</div>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Project Type:</label>
                            <select id="type" name="project_type" class="form-select" required>
                                <option value="Web">Web</option>
                                <option value="Mobile">Mobile</option>
                                <option value="Desktop">Desktop</option>
                            </select>
                            <div class="invalid-feedback">Please select a project type.</div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="Pending">Pending</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                            </select>
                            <div class="invalid-feedback">Please select a status.</div>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                            <div class="invalid-feedback">Please select a start date.</div>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date (Optional):</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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
