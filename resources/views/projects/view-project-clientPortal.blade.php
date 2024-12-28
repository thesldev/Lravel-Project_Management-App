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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

    <!-- jQuery (necessary for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Support Tickets</h6>
                            <button id="createTicketBtn" class="btn btn-primary btn-sm">
                                <i class="bi bi-ticket"></i> Create Ticket
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row ticket-container">
                                <!-- Tickets will be dynamically appended here -->
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

    <!-- Create Support Ticket Modal -->
    <div id="createTicketModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTicketModalLabel">Create Support Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createTicketForm">
                        <div class="mb-3">
                            <label for="ticketTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="ticketTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="ticketDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="ticketDescription" name="description" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="ticketPriority" class="form-label">Priority</label>
                            <select class="form-select" id="ticketPriority" name="priority" required>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Critical">Critical</option>
                            </select>
                        </div>
                        <div cs="mb-3">
                            <label for="projectId" class="form-label">Project</label>
                            <input type="text" class="form-control" id="projectId" name="project_id" value="{{ $project->id }}" readonly>
                        </div>
                        <input type="hidden" id="clientId" name="client_id" value="{{ auth()->id() }}">
                        <input type="hidden" id="status" name="status" value="Open">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function () {
             // Set up CSRF token for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Show the modal when the button is clicked
            $('#createTicketBtn').on('click', function () {
                $('#createTicketModal').modal('show');
            });

            // Handle the form submission via Ajax
            $('#createTicketForm').on('submit', function (e) {
                e.preventDefault();

                // Get form data
                const formData = $(this).serialize();

                // Send an Ajax request
                $.ajax({
                    url: '/support_tickets/create', // Replace with your route URL
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        alert('Ticket created successfully!');
                        $('#createTicketModal').modal('hide');
                        // Optionally, refresh the ticket list or page
                    },
                    error: function (xhr) {
                        alert('Failed to create ticket. Please try again.');
                    }
                });
            });

            // Function to fetch tickets
            function fetchTickets(projectId) {
                $.ajax({
                    url: `/my-prokects/${projectId}/ticket-history`, // Replace with the correct route URL
                    method: 'GET',
                    success: function (response) {
                        const ticketContainer = $('.ticket-container');

                        // Clear any previous content
                        ticketContainer.empty();

                        // Check if tickets are available
                        if (response.tickets && response.tickets.length > 0) {
                            response.tickets.forEach(ticket => {
                                const ticketHtml = `
                                    <div class="col-12 mb-3">
                                        <div class="card shadow-sm">
                                            <!-- Header Section -->
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="mb-0 me-2">${ticket.title}</h5> 
                                                    <span class="badge bg-primary">#${ticket.id}</span>
                                                </div>
                                            </div>

                                            <!-- Body Section -->
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <!-- Ticket Description -->
                                                <div class="flex-grow-1">
                                                    <p class="card-text mb-1">
                                                        ${ticket.description}
                                                    </p>
                                                </div>

                                                <!-- Dropdown Button -->
                                                <div class="dropdown">
                                                    <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('project.viewMyProject', ['id' => $project->id]) }}">
                                                                <i class="bi bi-info-lg"></i> Info
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- Footer Section -->
                                            <div class="card-footer d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="text-muted" style="font-size: 0.9rem;">
                                                        <strong>Created At:</strong> ${new Date(ticket.created_at).toLocaleString()}
                                                    </span>
                                                </div>
                                                <div>
                                                    <span class="text-muted">status:</span> 
                                                    <span class="badge ${
                                                        ticket.status === 'Resolved' ? 'bg-success' :
                                                        ticket.status === 'In Progress' ? 'bg-info text-dark' :
                                                        ticket.status === 'On Hold' ? 'bg-warning text-dark' :
                                                        'bg-secondary'
                                                    }">
                                                        ${ticket.status}
                                                    </span>
                                                    <span class="text-muted ms-3">priority:</span> 
                                                    <span class="badge ${
                                                        ticket.priority === 'Critical' ? 'bg-danger' :
                                                        ticket.priority === 'High' ? 'bg-warning text-dark' :
                                                        ticket.priority === 'Medium' ? 'bg-primary' :
                                                        'bg-secondary'
                                                    }">
                                                        ${ticket.priority}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                ticketContainer.append(ticketHtml);
                            });
                        } else {
                            // Display a message if no tickets are found
                            ticketContainer.append('<p>No tickets found for this project.</p>');
                        }
                    },
                    error: function () {
                        alert('Failed to load tickets. Please try again.');
                    }
                });
            }

            // Fetch tickets on page load
            const projectId = "{{ $project->id }}"; // Replace with your dynamic project ID
            fetchTickets(projectId);
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