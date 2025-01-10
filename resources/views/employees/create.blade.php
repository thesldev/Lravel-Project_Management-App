<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>New Employee - Admin Dashboard</title>

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
                            <select class="form-select" id="job_role" name="job_role" required>
                                <option value="" disabled selected>Select a job role</option>
                                <!-- Development -->
                                <optgroup label="Development">
                                    <option value="Front-End Developer">Front-End Developer</option>
                                    <option value="Back-End Developer">Back-End Developer</option>
                                    <option value="Full-Stack Developer">Full-Stack Developer</option>
                                    <option value="Mobile App Developer">Mobile App Developer</option>
                                    <option value="Game Developer">Game Developer</option>
                                    <option value="Software Developer">Software Developer</option>
                                    <option value="Web Developer">Web Developer</option>
                                </optgroup>
                                <!-- Software Engineering -->
                                <optgroup label="Software Engineering">
                                    <option value="Software Engineer">Software Engineer</option>
                                    <option value="Application Engineer">Application Engineer</option>
                                    <option value="Embedded Systems Engineer">Embedded Systems Engineer</option>
                                    <option value="Systems Software Engineer">Systems Software Engineer</option>
                                    <option value="Firmware Engineer">Firmware Engineer</option>
                                </optgroup>
                                <!-- Cloud Engineering -->
                                <optgroup label="Cloud Engineering">
                                    <option value="Cloud Engineer">Cloud Engineer</option>
                                    <option value="Cloud Solutions Architect">Cloud Solutions Architect</option>
                                    <option value="Cloud DevOps Engineer">Cloud DevOps Engineer</option>
                                    <option value="Cloud Security Engineer">Cloud Security Engineer</option>
                                    <option value="Cloud Infrastructure Engineer">Cloud Infrastructure Engineer</option>
                                </optgroup>
                                <!-- Developer Operations (DevOps) -->
                                <optgroup label="Developer Operations (DevOps)">
                                    <option value="DevOps Engineer">DevOps Engineer</option>
                                    <option value="Site Reliability Engineer (SRE)">Site Reliability Engineer (SRE)</option>
                                    <option value="Build and Release Engineer">Build and Release Engineer</option>
                                    <option value="Infrastructure Engineer">Infrastructure Engineer</option>
                                </optgroup>
                                <!-- Data Engineering -->
                                <optgroup label="Data Engineering">
                                    <option value="Data Engineer">Data Engineer</option>
                                    <option value="Data Architect">Data Architect</option>
                                    <option value="Big Data Engineer">Big Data Engineer</option>
                                    <option value="Machine Learning Engineer">Machine Learning Engineer</option>
                                    <option value="Artificial Intelligence Engineer">Artificial Intelligence Engineer</option>
                                </optgroup>
                                <!-- Quality Assurance (QA) -->
                                <optgroup label="Quality Assurance (QA)">
                                    <option value="QA Engineer">QA Engineer</option>
                                    <option value="Test Automation Engineer">Test Automation Engineer</option>
                                    <option value="Performance Tester">Performance Tester</option>
                                    <option value="QA Analyst">QA Analyst</option>
                                    <option value="Manual Tester">Manual Tester</option>
                                </optgroup>
                                <!-- Business Analytics -->
                                <optgroup label="Business Analytics">
                                    <option value="Business Analyst">Business Analyst</option>
                                    <option value="Data Analyst">Data Analyst</option>
                                    <option value="Product Analyst">Product Analyst</option>
                                    <option value="Systems Analyst">Systems Analyst</option>
                                </optgroup>
                                <!-- Project Management -->
                                <optgroup label="Project Management">
                                    <option value="Project Manager">Project Manager</option>
                                    <option value="Scrum Master">Scrum Master</option>
                                    <option value="Technical Program Manager">Technical Program Manager</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback">Please select a job role.</div>
                        </div>


                        <div class="mb-3">
                            <label for="position" class="form-label">Position:</label>
                            <select class="form-select" id="position" name="position" required>
                                <option value="" disabled selected>Select a position</option>
                                <!-- Entry-Level Positions -->
                                <optgroup label="Entry-Level">
                                    <option value="Intern">Intern</option>
                                    <option value="Junior Developer">Junior Developer</option>
                                    <option value="Junior Software Engineer">Junior Software Engineer</option>
                                    <option value="Junior Data Analyst">Junior Data Analyst</option>
                                    <option value="IT Support Intern">IT Support Intern</option>
                                    <option value="QA Intern">QA Intern</option>
                                    <option value="Technical Support Specialist">Technical Support Specialist</option>
                                </optgroup>
                                <!-- Mid-Level Positions -->
                                <optgroup label="Mid-Level">
                                    <option value="Software Developer">Software Developer</option>
                                    <option value="Data Analyst">Data Analyst</option>
                                    <option value="DevOps Engineer">DevOps Engineer</option>
                                    <option value="Systems Administrator">Systems Administrator</option>
                                    <option value="Cloud Engineer">Cloud Engineer</option>
                                    <option value="QA Engineer">QA Engineer</option>
                                    <option value="UI/UX Designer">UI/UX Designer</option>
                                    <option value="Product Manager">Product Manager</option>
                                    <option value="IT Specialist">IT Specialist</option>
                                    <option value="Network Engineer">Network Engineer</option>
                                </optgroup>
                                <!-- Senior-Level Positions -->
                                <optgroup label="Senior-Level">
                                    <option value="Senior Developer">Senior Developer</option>
                                    <option value="Senior Software Engineer">Senior Software Engineer</option>
                                    <option value="Senior Data Engineer">Senior Data Engineer</option>
                                    <option value="Senior Cloud Architect">Senior Cloud Architect</option>
                                    <option value="Senior DevOps Engineer">Senior DevOps Engineer</option>
                                    <option value="Senior QA Analyst">Senior QA Analyst</option>
                                    <option value="Senior Product Manager">Senior Product Manager</option>
                                    <option value="Technical Lead">Technical Lead</option>
                                    <option value="IT Project Manager">IT Project Manager</option>
                                    <option value="Senior Business Analyst">Senior Business Analyst</option>
                                </optgroup>
                                <!-- Managerial and Leadership Positions -->
                                <optgroup label="Managerial & Leadership">
                                    <option value="IT Manager">IT Manager</option>
                                    <option value="Engineering Manager">Engineering Manager</option>
                                    <option value="QA Manager">QA Manager</option>
                                    <option value="Product Owner">Product Owner</option>
                                    <option value="Director of Technology">Director of Technology</option>
                                    <option value="Chief Technology Officer">Chief Technology Officer (CTO)</option>
                                    <option value="Chief Information Officer">Chief Information Officer (CIO)</option>
                                    <option value="VP of Engineering">VP of Engineering</option>
                                </optgroup>
                                <!-- Specialist Positions -->
                                <optgroup label="Specialist Positions">
                                    <option value="Cloud Solutions Architect">Cloud Solutions Architect</option>
                                    <option value="Data Architect">Data Architect</option>
                                    <option value="Network Architect">Network Architect</option>
                                    <option value="Security Architect">Security Architect</option>
                                    <option value="Machine Learning Engineer">Machine Learning Engineer</option>
                                    <option value="Blockchain Developer">Blockchain Developer</option>
                                    <option value="AI Researcher">AI Researcher</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback">Please select a position.</div>
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
        $(document).ready(function () {
            // Set CSRF token for all Ajax requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle form submission
            $('#employeeForm').on('submit', function (event) {
                event.preventDefault(); 
                
                // Serialize form data
                const formData = $(this).serialize();
                
                // Send Ajax POST request
                $.ajax({
                    url: '/employee', 
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#response').html('<p style="color:green;">Employee added successfully!</p>');
                        $('#employeeForm')[0].reset(); 
                        $('#employeeForm').removeClass('was-validated'); // Reset validation
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
