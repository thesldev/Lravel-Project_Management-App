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
                            <h6 class="m-0 font-weight-bold text-primary">Sprint #{{ $sprint->id }} | Issues in Sprint</h6>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#issuesModal">
                                            <i class="bi bi-bookmark-plus"></i> Add Issue
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#removeIssueModal">
                                            <i class="bi bi-trash-fill"></i> Remove Issue
                                        </button>
                                    </li>
                                </ul>
                            </div>
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

    <!-- View Issue Modal -->
    <div class="modal fade" id="viewIssueModal" tabindex="-1" aria-labelledby="viewIssueModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewIssueModalLabel">Select an Issue to View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewIssuesContainer">
                    <!-- Issues will be dynamically populated here -->
                    <p>Loading issues...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Remove Issue Modal -->
    <div class="modal fade" id="removeIssueModal" tabindex="-1" aria-labelledby="removeIssueModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeIssueModalLabel">Select an Issue to Remove</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="removeIssuesContainer">
                    <!-- Issues will be dynamically populated here -->
                    <p>Loading issues...</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="jquery.sortable.js"></script>
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


    <!-- add issues into Issue table. -->
    <script>
        $(document).ready(function() {
            let projectId = JSON.parse('@json($sprint->project->id)');
            let sprintId = '{{ $sprint->id }}'; // Pass the sprint ID from Blade template

            // Fetch issues already in the sprint
            $.ajax({
                url: '{{ route("issuesInSprint.getIssues") }}',
                type: 'GET',
                data: { sprint_id: sprintId },
                dataType: 'json',
                success: function(response) {
                    let sprintIssueIds = response.map(issue => issue.issue.id);

                    // Fetch all issues from the backlog
                    $.ajax({
                        url: '{{ route("backlog.getIssues") }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function(issues) {
                            let issuesHtml = '';
                            let filteredIssues = issues.filter(issue => issue.project_id === projectId && !sprintIssueIds.includes(issue.id));

                            // Render issues dynamically
                            filteredIssues.forEach(issue => {
                                // Determine the priority badge color
                                let priorityColor;
                                switch (issue.priority) {
                                    case 'Low':
                                        priorityColor = 'bg-success'; 
                                        break;
                                    case 'Medium':
                                        priorityColor = 'bg-warning';
                                        break;
                                    case 'High':
                                        priorityColor = 'bg-danger';
                                        break;
                                    case 'Critical':
                                        priorityColor = 'bg-dark'; 
                                        break;
                                    default:
                                        priorityColor = 'bg-secondary'; 
                                }

                                // Generate the HTML for each issue
                                issuesHtml += `
                                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${issue.id}">
                                        <span>${issue.title}</span>
                                        <span class="d-flex gap-3 align-items-center">
                                            <span class="badge bg-info">${issue.status}</span>
                                            <span class="badge ${priorityColor}">${issue.priority}</span>
                                            <!-- Dropdown button for actions -->
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm " type="button" id="dropdownMenuButton${issue.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${issue.id}">
                                                    <li>
                                                        <button class="dropdown-item btn-update" data-id="${issue.id}">
                                                            <i class="bi bi-save2-fill"></i>
                                                            <span class="ms-2">Update</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item btn-delete" data-id="${issue.id}">
                                                            <i class="bi bi-trash-fill"></i>
                                                            <span class="ms-2">Delete</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </span>
                                    </li>
                                `;
                            });

                            $('#issue-list').html(issuesHtml);

                            // Initialize sortable after loading data
                            $('#issue-list').sortable({
                                placeholderClass: 'sortable-placeholder',
                                items: 'li',
                                update: function(event, ui) {
                                    let sortedIds = $(this).sortable('toArray', { attribute: 'data-id' });
                                    console.log('New order:', sortedIds);

                                    // Update the order on the server
                                    $.ajax({
                                        url: '{{ route("backlog.updateOrder") }}',
                                        type: 'POST',
                                        data: {
                                            order: sortedIds,
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(response) {
                                            alert(response.message || 'Order updated successfully!');
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Failed to update order:', error);
                                        }
                                    });
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to load issues:', error);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load sprint issues:', error);
                }
            });
        });
    </script>

    <!-- script to manage issues inside the sprint -->
    <script>
        $(document).ready(function() {
            // Add issues in sprint when the 'Add Issue' button is clicked
            $('#issuesModal').on('show.bs.modal', function () {
                $('#issuesContainer').html('<p>Loading issues...</p>');

                // Fetch issues already in the sprint
                let projectId = JSON.parse('@json($sprint->project->id)');
                let sprintId = '{{ $sprint->id }}';

                $.ajax({
                    url: '{{ route("issuesInSprint.getIssues") }}',
                    type: 'GET',
                    data: { sprint_id: sprintId },
                    dataType: 'json',
                    success: function(sprintIssues) {
                        let sprintIssueIds = sprintIssues.map(issue => issue.issue.id);

                        // Fetch issues from the backlog
                        $.ajax({
                            url: '{{ route("backlog.getIssues") }}',
                            type: 'GET',
                            success: function(response) {
                                $('#issuesContainer').html('');

                                // Filter issues based on project ID and sprint issues
                                let filteredIssues = response.filter(issue =>
                                    issue.project_id === projectId && !sprintIssueIds.includes(issue.id)
                                );

                                if (filteredIssues.length > 0) {
                                    let issuesList = '<ul class="list-group">';
                                    filteredIssues.forEach(issue => {
                                        issuesList += `
                                            <li class="list-group-item" data-id="${issue.id}" style="cursor: pointer;">
                                                ${issue.title}
                                            </li>
                                        `;
                                    });
                                    issuesList += '</ul>';
                                    $('#issuesContainer').html(issuesList);
                                } else {
                                    $('#issuesContainer').html('<p>No issues found for this project.</p>');
                                }
                            },
                            error: function() {
                                $('#issuesContainer').html('<p>Failed to load issues. Please try again later.</p>');
                            }
                        });
                    },
                    error: function() {
                        $('#issuesContainer').html('<p>Failed to load sprint issues. Please try again later.</p>');
                    }
                });
            });

            // Handle issue click to add it to the sprint
            $('#issuesContainer').on('click', '.list-group-item', function() {
                let issueId = $(this).data('id');
                let sprintId = '{{ $sprint->id }}';

                $.ajax({
                    url: '{{ route("issuesInSprint.store") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
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

            // Load issues in sprint when the page loads
            const sprintId = '{{ $sprint->id }}';

            function loadIssuesInSprint() {
                $.ajax({
                    url: '{{ route("issuesInSprint.getIssues") }}',
                    type: 'GET',
                    data: { sprint_id: sprintId },
                    dataType: 'json',
                    success: function(response) {
                        let issuesHtml = '';
                        response.forEach(issue => {
                            let priorityColor;
                            switch (issue.issue.priority) {
                                case 'Low': priorityColor = 'bg-success'; break;
                                case 'Medium': priorityColor = 'bg-warning'; break;
                                case 'High': priorityColor = 'bg-danger'; break;
                                case 'Critical': priorityColor = 'bg-dark'; break;
                                default: priorityColor = 'bg-secondary';
                            }

                            issuesHtml += `<li class="list-group-item d-flex justify-content-between align-items-center" data-id="${issue.issue.id}" id="issue-${issue.issue.id}">
                                <span>${issue.issue.title}</span>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-info me-2">${issue.issue.status}</span>
                                    <span class="badge ${priorityColor} me-2">${issue.issue.priority || 'N/A'}</span>
                                </div>
                            </li>`;
                        });
                        $('#issue-In-Sprint-list').html(issuesHtml);

                        // Make the list sortable
                        $('#issue-In-Sprint-list').sortable({
                            placeholder: 'sortable-placeholder',
                            items: 'li',
                        }).on('sortupdate', function() {
                            const sortedIds = $(this).sortable('toArray', { attribute: 'data-id' });
                            updateOrder(sortedIds);
                        });

                        // Add event listener for remove buttons
                        $('.btn-remove').on('click', function() {
                            const issueId = $(this).data('id');
                            removeIssueFromSprint(issueId);
                        });
                    },
                    error: function() {
                        console.error('Failed to load sprint issues.');
                    }
                });
            }

            function updateOrder(sortedIds) {
                $.ajax({
                    url: '{{ route("issuesInSprint.updateOrder") }}',
                    type: 'POST',
                    data: {
                        order: sortedIds,
                        _token: '{{ csrf_token() }}',
                        sprint_id: sprintId
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function() {
                        alert('Failed to update the order. Please try again.');
                    }
                });
            }
            // Load issues on page load
            loadIssuesInSprint();
        });
    </script>

    <!-- script for add & remove issues into sprint -->
    <script>
        $(document).ready(function() {
            $('#removeIssueModal').on('show.bs.modal', function() {
                let sprintId = '{{ $sprint->id }}'; // Get sprint ID from Blade

                $.ajax({
                    url: '{{ route("issuesInSprint.getIssues") }}',
                    type: 'GET',
                    data: { sprint_id: sprintId },
                    dataType: 'json',
                    success: function(response) {
                        let issuesHtml = '';
                        if (response && response.length > 0) {
                            response.forEach(issue => {
                                issuesHtml += `
                                    <div class="issue-item d-flex justify-content-between align-items-center mb-3">
                                        <span>${issue.issue.title} (ID: ${issue.issue.id})</span>
                                        <button class="btn btn-danger btn-sm me-2 remove-issue-btn" data-id="${issue.issue.id}">Remove</button>
                                    </div>
                                `;
                            });
                        } else {
                            issuesHtml = '<p>No issues found in the sprint.</p>';
                        }
                        $('#removeIssuesContainer').html(issuesHtml);
                    },
                    error: function() {
                        $('#removeIssuesContainer').html('<p>Failed to load issues. Please try again later.</p>');
                    }
                });
            });

            $('#removeIssuesContainer').on('click', '.remove-issue-btn', function() {
                let issueId = $(this).data('id');
                let confirmation = confirm('Are you sure you want to remove this issue?');

                if (confirmation) {
                    $.ajax({
                        url: '{{ route("issuesInSprint.destroy", ["issueId" => "__issueId__"]) }}'.replace("__issueId__", issueId),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Issue removed successfully.');
                            $('#removeIssueModal').modal('hide');
                        },
                        error: function(xhr) {
                            alert('An error occurred while removing the issue.');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>