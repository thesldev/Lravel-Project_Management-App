<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>General Tickets - Client Portal</title>

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Include Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

     <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

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
                    <h1 class="h3 mb-4 text-gray-800">General Tickets</h1>

                    <!-- active tickets -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Handle General Tickets</h6>

                            <div class="dropdown">
                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item" id="createTicket" data-bs-toggle="modal" data-bs-target="#assignMemberModal">
                                            <i class="bi bi-ticket-perforated-fill" style="transform: rotate(45deg); display: inline-block;"></i>
                                         Create Ticket
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item ">
                                            <i class="bi bi-ticket-perforated-fill" style="transform: rotate(45deg); display: inline-block;"></i>
                                         All Tickets
                                        </a>
                                    </li>
                                </ul>
                                <!-- Hidden input to store ticket ID -->
                                <input type="hidden" id="ticketId" name="id" value=""><!-- Replace 12345 with dynamic ticket ID -->
                            </div>

                        </div>
                        <!-- display ticket data -->
                        <div class="card-body">
                            <div class="row">
                                @if($tickets->isEmpty())
                                    <p class="text-center">No tickets found.</p>
                                @else
                                    <div class="col-12" style="max-height: 400px; overflow-y: auto;">
                                        @foreach($tickets as $ticket)
                                            <div class="mb-3">
                                                <div class="card shadow-sm">
                                                    <!-- Header Section -->
                                                    <div class="card-header d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mb-0 me-2">{{ $ticket->subject }}</h5> 
                                                            <span class="badge bg-primary">#{{ $ticket->id }}</span>
                                                        </div>
                                                    </div>

                                                    <!-- Body Section -->
                                                    <div class="card-body d-flex justify-content-between align-items-center">
                                                        <!-- Ticket Description -->
                                                        <div class="flex-grow-1">
                                                            <p class="card-text mb-1">
                                                                {{ Str::limit($ticket->description, 100) }}
                                                            </p>
                                                        </div>

                                                        <!-- Dropdown Button -->
                                                        <div class="dropdown">
                                                            <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{route('ticket.viewGeneralTicket', ['id' => $ticket->id])}}">
                                                                        <i class="bi bi-eye"></i> View Ticket
                                                                    </a>
                                                                </li>
                                                                <form action="{{ route('generalTickets.close', $ticket->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to close this ticket?');">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="bi bi-x-circle"></i> Close Ticket
                                                                    </button>
                                                                </form>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <!-- Footer Section -->
                                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <span class="text-muted" style="font-size: 0.9rem;">
                                                                <strong>Created At:</strong> {{ $ticket->created_at->format('Y-m-d H:i') }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="text-muted">Status:</span> 
                                                            <span class="badge 
                                                                {{ match($ticket->status) {
                                                                    'in-progress' => 'bg-primary text-white',       
                                                                    'open' => 'bg-info text-white',             
                                                                    'on-hold' => 'bg-warning text-dark',           
                                                                    'resolved' => 'bg-success bg-opacity-75 text-white',        
                                                                    'closed' => 'bg-danger text-white',           
                                                                    default => 'bg-secondary text-white',         
                                                                } }}">
                                                                {{ ucfirst($ticket->status) }}
                                                            </span>
                                                            <span class="text-muted ms-3">Priority:</span> 
                                                            <span class="badge 
                                                                {{ match($ticket->priority) {
                                                                    'high' => 'bg-danger',
                                                                    'medium' => 'bg-warning text-dark',
                                                                    'low' => 'bg-primary',
                                                                    default => 'bg-secondary',
                                                                } }}">
                                                                {{ ucfirst($ticket->priority) }}
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Closed Tickets Section -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Closed & Resolved General Tickets</h6>
                        </div>

                        <!-- Scrollable Ticket Section -->
                        <div class="card-body">
                            <div class="row">
                                @if($closedTickets->isEmpty())
                                    <p class="text-center">No tickets found.</p>
                                @else
                                    <!-- Scrollable Container -->
                                    <div class="col-12" style="max-height: 400px; overflow-y: auto;">
                                        @foreach($closedTickets as $closedTicket)
                                            <div class="mb-3">
                                                <div class="card shadow-sm">
                                                    <!-- Header Section -->
                                                    <div class="card-header d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mb-0 me-2">{{ $closedTicket->subject }}</h5> 
                                                            <span class="badge bg-primary">#{{ $closedTicket->id }}</span>
                                                        </div>
                                                    </div>

                                                    <!-- Body Section -->
                                                    <div class="card-body d-flex justify-content-between align-items-center">
                                                        <div class="flex-grow-1">
                                                            <p class="card-text mb-1">
                                                                {{ Str::limit($closedTicket->description, 100) }}
                                                            </p>
                                                        </div>

                                                        <!-- Dropdown Button -->
                                                        <div class="dropdown">
                                                            <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{route('ticket.viewGeneralTicket', ['id' => $closedTicket->id])}}">
                                                                        <i class="bi bi-eye"></i> View Ticket
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <!-- Footer Section -->
                                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <span class="text-muted" style="font-size: 0.9rem;">
                                                                <strong>Created At:</strong> {{ $closedTicket->created_at->format('Y-m-d H:i') }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="text-muted">Status:</span> 
                                                            <span class="badge 
                                                                {{ match($closedTicket->status) {
                                                                    'in-progress' => 'bg-primary text-white',       
                                                                    'open' => 'bg-success text-white',             
                                                                    'on-hold' => 'bg-warning text-dark',           
                                                                    'resolved' => 'bg-success bg-opacity-75 text-white',        
                                                                    'closed' => 'bg-danger text-white',           
                                                                    default => 'bg-secondary text-white',         
                                                                } }}">
                                                                {{ ucfirst($closedTicket->status) }}
                                                            </span>

                                                            <span class="text-muted ms-3">Priority:</span> 
                                                            <span class="badge 
                                                                {{ match($closedTicket->priority) {
                                                                    'high' => 'bg-danger',
                                                                    'medium' => 'bg-warning text-white',
                                                                    'low' => 'bg-primary',
                                                                    default => 'bg-secondary',
                                                                } }} ">
                                                                {{ ucfirst($closedTicket->priority) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
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


    <!-- Create Ticket Modal -->
    <div class="modal fade" id="assignMemberModal" tabindex="-1" aria-labelledby="assignMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTicket">Create General Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createTicketForm" action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-control" id="priority" name="priority" required>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="attachments" class="form-label">Attachments</label>
                            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                            <small class="text-muted">You can upload multiple files (Max: 2MB each)</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Jquey scripts for fetch project and employee data -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- jQuery (necessary for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- script for disable submit button until get the response -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("createTicketForm");

            if (form) {
                form.addEventListener("submit", function (event) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    const closeButton = document.querySelector("#assignMemberModal .btn-close");

                    // Disable buttons and show user feedback
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.textContent = "Submitting...";
                    }

                    if (closeButton) {
                        closeButton.disabled = true;
                    }
                });
            }
        });
    </script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
