<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>View General Ticket - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet" />

    <!-- jQuery (necessary for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('css/comments-styles.css') }}" rel="stylesheet" />

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
                    <h1 class="h3 mb-4 text-gray-800">General-Ticket  #{{ $ticket->id }} Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Ticket #{{ $ticket->id }} Information | Created At: {{ $ticket->created_at }}</h6>
                            
                            <input type="hidden" id="ticketId" value="{{ $ticket->id }}">

                            <!-- Dropdown Button -->
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateGeneralTicketModal">
                                            <i class="bi bi-file-earmark-break-fill"></i> Mark as Resolved
                                        </a>
                                    </li>
                                    <li class="dropdown-item position-relative">
                                        <a href="#" id="changePriorityButton">
                                            <i class="bi bi-arrow-clockwise"></i> Change Status
                                        </a>
                                        <!-- Status List -->
                                        <div id="priorityList" class="status-popup position-absolute d-none">
                                            <ul class="list-unstyled mb-0">
                                                <li class="dropdown-item" data-status="open">Open</li>
                                                <li class="dropdown-item" data-status="in-progress">In Progress</li>
                                                <li class="dropdown-item" data-status="on-hold">On Hold</li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- display ticket data -->
                        <div class="card-body">
                            <div class="row">
                                <!-- Ticket Title -->
                                <p>Ticket Title: <strong>{{ $ticket->subject }}</strong></p>

                                <!-- Ticket Priority -->
                                <div class="col-md-3 me-3">
                                    <p>Ticket Priority: 
                                        <span class="badge 
                                            {{ $ticket->priority === 'high' ? 'bg-danger' : '' }}
                                            {{ $ticket->priority === 'medium' ? 'bg-primary' : '' }}
                                            {{ $ticket->priority === 'low' ? 'bg-secondary' : '' }}">
                                            {{ $ticket->priority }}
                                        </span>
                                    </p>
                                </div>

                                <!-- Ticket Status -->
                                <div class="col-md-3 me-3">
                                    <p>Ticket Status: 
                                        <span class="badge 
                                            {{ $ticket->status === 'in-progress' ? 'bg-info text-dark' : '' }}
                                            {{ $ticket->status === 'on-hold' ? 'bg-warning text-dark' : '' }}
                                            {{ $ticket->status === 'resolved' ? 'bg-success' : '' }}
                                            {{ $ticket->status === 'closed' ? 'bg-danger' : '' }}
                                            {{ $ticket->status === 'open' ? 'bg-primary' : '' }}">
                                            {{ $ticket->status }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <!-- Remaining Ticket Details -->
                            <div class="mt-2">    
                                <p class="mb-3">Created By: <strong>{{ $ticket->client->name }}</strong></p>
                                <p class="mb-3">Ticket Description: <strong>{{ $ticket->description }}</strong></p>
                            </div>

                           <!-- Attachments Section -->
                            <div class="mt-4">
                                <h6>Attachments:</h6>
                                @if($ticket->attachments && $ticket->attachments->isNotEmpty())
                                    <ul class="list-group">
                                        @foreach($ticket->attachments as $attachment)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>{{ $attachment->file_name }}</span>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ asset('storage/' . $attachment->file_path) }}" 
                                                    class="btn btn-sm btn-outline-primary" 
                                                    target="_blank">
                                                        View
                                                    </a>
                                                    <a href="{{ asset('storage/' . $attachment->file_path) }}" 
                                                    class="btn btn-sm btn-outline-primary" 
                                                    download="{{ $attachment->file_name }}">
                                                        Download
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No attachments available for this ticket.</p>
                                @endif
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

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome (optional, for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const changeStatusButton = document.getElementById('changePriorityButton');
            const statusList = document.getElementById('priorityList');
            const statusItems = statusList.querySelectorAll('.dropdown-item');

            // Show status list when hovering
            changeStatusButton.addEventListener('mouseenter', function () {
                statusList.classList.remove('d-none');
            });

            // Hide status list when mouse leaves
            changeStatusButton.addEventListener('mouseleave', function () {
                setTimeout(() => {
                    if (!statusList.matches(':hover')) {
                        statusList.classList.add('d-none');
                    }
                }, 200);
            });

            statusList.addEventListener('mouseenter', function () {
                statusList.classList.remove('d-none');
            });

            statusList.addEventListener('mouseleave', function () {
                statusList.classList.add('d-none');
            });

            // Handle click on status items
            statusItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    const selectedStatus = item.getAttribute('data-status');
                    const ticketIdElement = document.getElementById('ticketId');

                    if (!ticketIdElement) {
                        alert("Error: Ticket ID not found.");
                        return;
                    }

                    const ticketId = ticketIdElement.value;

                    if (confirm(`Are you sure you want to change the status to: ${selectedStatus}?`)) {
                        updateTicketStatus(ticketId, selectedStatus);
                    }
                });
            });

        });

        // Function to update the ticket status via AJAX
        async function updateTicketStatus(ticketId, status) {
            try {
                const response = await fetch(`/general-ticket/${ticketId}/change-status-admin`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ status }),
                });

                const result = await response.json();

                if (result.success) {
                    alert(`Status updated to: ${status}`);
                    location.reload();
                } else {
                    alert(`Failed to update status: ${result.message}`);
                }
            } catch (error) {
                console.error('Error updating status:', error);
                alert('An error occurred while updating the status.');
            }
        }

    </script>


</body>
</html>