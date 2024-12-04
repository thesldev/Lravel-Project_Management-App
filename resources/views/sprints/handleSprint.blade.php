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
    
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
     <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/draopZone.css') }}" rel="stylesheet" />

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
                    <h1 class="h3 mb-2 text-gray-800">Sprint #{{ $sprint->id }} | Project: {{$sprint->project->name}}</h1>

                    <p class="mb-4">{{$sprint->description}}</p>

                    <!-- issues in sprint -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Sprint #{{ $sprint->id }} | Issueses In Sprint</h6>
                            <button id="fetchIssuesBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#issuesModal">
                             Add In To Sprint
                            </button>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <ul id="issue-In-Sprint-list" class="list-group list-group-sortable">
                                    <!-- Issues will be populated dynamically -->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- card for display issue list -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Sprint #{{ $sprint->id }} | Issues List</h6>
                            <!-- Create Issue Button -->
                            <button id="createIssueBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createIssueModal">
                                <i class="fas fa-plus"></i> New Issue
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <ul id="issue-list" class="list-group list-group-sortable">
                                    <!-- Issues will be populated dynamically -->
                                </ul>
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

    <!-- Modal for Creating New Issue -->
    <div class="modal fade" id="createIssueModal" tabindex="-1" aria-labelledby="createIssueModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createIssueModalLabel">Create New Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createIssueForm">
                        <div class="mb-3">
                            <label for="issueTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="issueTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="issueDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="issueDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="issuePriority" class="form-label">Priority</label>
                            <select class="form-select" id="issuePriority">
                                <option value="Low">Low</option>
                                <option value="Medium" selected>Medium</option>
                                <option value="High">High</option>
                                <option value="Critical">Critical</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="projectSelect" class="form-label">Project</label>
                            <select class="form-select" id="projectSelect" disabled>
                                <option value="{{ $sprint->project->id }}" selected>{{ $sprint->project->name }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sprintSelect" class="form-label">Sprint</label>
                            <select class="form-select" id="sprintSelect" disabled>
                                <option value="{{ $sprint->id }}" selected>{{ $sprint->title }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="statusSelect" class="form-label">Status</label>
                            <select class="form-select" id="statusSelect">
                                <option value="Backlog" selected>Backlog</option>
                                <option value="In Sprint">In Sprint</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="created_by" class="form-label">Created By</label>
                            <input type="text" class="form-control" id="created_by" name="created_by" value="{{ auth()->user()->id }}" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Issue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to display all issues -->
    <div class="modal fade" id="issuesModal" tabindex="-1" aria-labelledby="issuesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="issuesModalLabel">Issues List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="issuesContainer">
                    <!-- Issues will be populated here -->
                    <p>Loading issues...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="path/to/jquery.sortable.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- ajax & jquery for store issues in database -->
    <script>
        $(document).ready(function() {
            $('#createIssueForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Gather form data
                var formData = {
                    title: $('#issueTitle').val(),
                    description: $('#issueDescription').val(),
                    priority: $('#issuePriority').val(),
                    project_id: $('#projectSelect').val(), // Get project ID (read-only)
                    sprint_id: $('#sprintSelect').val(), // Get sprint ID (read-only)
                    status: $('#statusSelect').val(),
                    created_by: $('#created_by').val() // Already set to current user ID
                };

                // Perform the AJAX request
                $.ajax({
                    url: '{{ route("backlog.store") }}', // The route URL for creating an issue
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for Laravel security
                    },
                    success: function(response) {
                        console.log('AJAX success response:', response);
                        alert('Issue created successfully');
                        window.location.href = '{{ route("sprint.managePage") }}';
                    },
                    statusCode: {
                        422: function(xhr) {
                            // Handle validation errors specifically
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key].join('\n') + '\n';
                                }
                            }
                            alert('Validation errors:\n' + errorMessages);
                        },
                        500: function(xhr) {
                            // Handle server errors
                            console.log(xhr);
                            alert('A server error occurred. Please try again later.');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Log details of the response for debugging
                        console.log('AJAX error status: ' + status);
                        console.log('AJAX error response:', xhr.responseJSON); // Log the response JSON if available

                        if (xhr.status !== 422) {
                            alert('An unexpected error occurred while creating the issue.');
                        }
                    }

                });
            });
        });
    </script>


    <!-- Add JavaScript to handle drag-and-drop -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropZone = document.getElementById("dropZone");
            const fileInput = document.getElementById("fileInput");
            const filePreview = document.getElementById("filePreview");

            // Highlight dropZone on drag events
            dropZone.addEventListener("dragover", (event) => {
                event.preventDefault();
                dropZone.style.backgroundColor = "#e2e6ea";
            });

            dropZone.addEventListener("dragleave", () => {
                dropZone.style.backgroundColor = "#f8f9fc";
            });

            // Handle file drop
            dropZone.addEventListener("drop", (event) => {
                event.preventDefault();
                dropZone.style.backgroundColor = "#f8f9fc";
                const files = event.dataTransfer.files;
                handleFiles(files);
            });
        });
    </script>

    <!-- add issues into Issue table. -->
    <script>
        $(document).ready(function() {
            // Pass the project ID from Blade to JavaScript
            let projectId = JSON.parse('@json($sprint->project->id)');
            
            $.ajax({
                url: '{{ route("backlog.getIssues") }}', 
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let issuesHtml = '';
                    // Filter issues based on project_id
                    let filteredIssues = response.filter(issue => issue.project_id === projectId);
                    
                    filteredIssues.forEach(issue => {
                        issuesHtml += `<li class="list-group-item" data-id="${issue.id}">${issue.title}</li>`;
                    });

                    $('#issue-list').html(issuesHtml);
                    // Initialize sortable after loading data
                    $('#issue-list').sortable({
                        placeholder: 'sortable-placeholder',
                        items: 'li' // Ensure only `li` elements can be dragged
                    }).on('sortupdate', function() {
                        let sortedIds = $(this).sortable('toArray', { attribute: 'data-id' });
                        console.log('New order:', sortedIds);

                        // Send the new order to the server
                        $.ajax({
                            url: '{{ route("backlog.updateOrder") }}',
                            type: 'POST',
                            data: {
                                order: sortedIds,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                alert(response.message);
                            },
                            error: function(xhr, status, error) {
                                console.error('Failed to update order:', error);
                            }
                        });
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load issues:', error);
                }
            });
        });
    </script>

    <!-- add issues into sprint -->
    <script>
        $(document).ready(function() {
            $('#fetchIssuesBtn').on('click', function() {
                // Make AJAX request to fetch issues
                $.ajax({
                    url: '{{ route("backlog.getIssues") }}',
                    type: 'GET',
                    success: function(response) {
                        // Clear the loading message and populate the modal with issues
                        $('#issuesContainer').html('');

                        if (response && response.length > 0) {
                            let issuesList = '<ul class="list-group">';
                            response.forEach(issue => {
                                issuesList += `
                                    <li class="list-group-item" data-id="${issue.id}" style="cursor: pointer;">
                                        ${issue.title}
                                    </li>
                                `;
                            });
                            issuesList += '</ul>';
                            $('#issuesContainer').html(issuesList);
                        } else {
                            $('#issuesContainer').html('<p>No issues found.</p>');
                        }
                    },
                    error: function() {
                        $('#issuesContainer').html('<p>Failed to load issues. Please try again later.</p>');
                    }
                });
            });

            // Handle issue click to add it to the sprint
            $('#issuesContainer').on('click', '.list-group-item', function() {
                let issueId = $(this).data('id');
                let sprintId = '{{ $sprint->id }}'; // Make sure $sprint is available in the Blade view

                $.ajax({
                    url: '{{ route("issuesInSprint.store") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        issue_id: issueId,
                        sprint_id: sprintId
                    },
                    success: function(response) {
                        alert(response.message);
                        // Optionally refresh or update the UI after successful addition
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred';
                        alert(errorMessage);
                    }
                });
            });
        });

        $(document).ready(function() {
        // Replace 'sprintId' with the actual sprint ID to fetch issues
        let sprintId = '{{ $sprint->id }}'; // Pass the sprint ID from Blade template

        // Fetch issues from the 'issues_in_sprint' table
        $.ajax({
            url: '{{ route("issuesInSprint.getIssues") }}',
            type: 'GET',
            data: { sprint_id: sprintId },
            dataType: 'json',
            success: function(response) {
                let issuesHtml = '';
                response.forEach(issue => {
                    issuesHtml += `<li class="list-group-item" data-id="${issue.id}">${issue.issue.title}</li>`;
                });
                $('#issue-In-Sprint-list').html(issuesHtml);

                // Initialize sortable after loading data
                $('#issue-In-Sprint-list').sortable({
                    placeholder: 'sortable-placeholder',
                    items: 'li' // Ensure only `li` elements can be dragged
                }).on('sortupdate', function() {
                    let sortedIds = $(this).sortable('toArray', { attribute: 'data-id' });
                    console.log('New order:', sortedIds);

                    // Send the new order to the server
                    $.ajax({
                        url: '{{ route("issuesInSprint.updateOrder") }}', // Create this route for updating order
                        type: 'POST',
                        data: {
                            order: sortedIds,
                            _token: '{{ csrf_token() }}',
                            sprint_id: sprintId
                        },
                        success: function(response) {
                            alert(response.message);
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to update order:', error);
                        }
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to load issues:', error);
            }
        });
    });
    </script>

</body>

</html>
