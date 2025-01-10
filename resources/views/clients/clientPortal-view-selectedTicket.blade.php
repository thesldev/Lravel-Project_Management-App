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
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet" />

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
                    <h1 class="h3 mb-4 text-gray-800">Client-Ticket  #{{ $ticket->id }} Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Ticket #{{ $ticket->id }} Information | Created At: {{ $ticket->created_at }}</h6>
                            <!-- Dropdown Button -->
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item" href="" id="updateTicketButton">
                                            <i class="bi bi-file-earmark-break-fill"></i> Update Ticket
                                        </a>
                                    </li>
                                    <li class="dropdown-item position-relative">
                                        <a href="#" id="changeStatusButton">
                                            <i class="bi bi-arrow-clockwise"></i> Change Status
                                        </a>
                                        <!-- Status List -->
                                        <div id="statusList" class="status-popup position-absolute d-none">
                                            <ul class="list-unstyled mb-0">
                                                <li class="dropdown-item" data-status="Open">Open</li>
                                                <li class="dropdown-item" data-status="On Hold">On Hold</li>
                                                <li class="dropdown-item" data-status="Resolved">Resolved</li>
                                                <li class="dropdown-item" data-status="Closed">Closed</li>
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
                                <p>Ticket Title:<strong>{{ $ticket->title }}</strong></p>

                                <!-- Ticket Priority -->
                                <div class="col-md-3 me-3 ">
                                    <p>Ticket Priority:<strong>{{ $ticket->priority }}</strong></p>
                                </div>

                                <!-- Ticket Type -->
                                <div class="col-md-3 me-3">
                                    <p>Ticket Type:<strong></strong> </p>
                                </div>

                                <!-- Ticket Status -->
                                <div class="col-md-3 me-3">
                                    <p>Ticket Status:<strong>{{ $ticket->status}}</strong></p>
                                </div>
                            </div>

                            <!-- Remaining Ticket Details -->
                            <div class="mt-2">    
                                <p class="mb-3">Created By: <strong>{{ $ticket->client->name }}</strong></p>
                                <p class="mb-3">Ticket Description: <strong>{{ $ticket->description }}</strong></p>
                                <p class="mb-3">
                                    Project Name: <strong>{{ $ticket->project->name }}</strong>
                                </p>
                                <p class="mb-3">Due Date: <strong></strong></p>
                            </div>
                            <form method="POST" action="{{ route('comments.storeAdmin', $ticket->id) }}">
                                @csrf
                                <div class="row mt-5">
                                    <h6 class="mb-3">Add a Comment:</h6>
                                    <div class="input-group">
                                        <textarea name="content" class="form-control" id="commentInput" placeholder="Write your comment here..." rows="2" required></textarea>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- ticket history section -->
                    <h1 class="h3 mb-4 text-gray-800">Ticket #{{ $ticket->id }} Comment History</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="ks-messages ks-messenger__messages">
                                <div
                                    class="ks-body ks-scrollable"
                                    style="height: 480px; overflow-y: auto; padding: 0;"
                                >
                                    <ul class="ks-items" id="comments-container">
                                        <!-- Comments will be dynamically injected here -->
                                    </ul>
                                </div>
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

    <!-- Update Ticket Modal -->
    <div class="modal fade" id="updateTicketModal" tabindex="-1" aria-labelledby="updateTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTicketModalLabel">Update Ticket #{{ $ticket->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="updateTicketForm">
                        <div class="mb-3">
                            <label for="ticketTitle" class="form-label">Ticket Title</label>
                            <input type="text" class="form-control" id="ticketTitle" name="title" value="{{ $ticket->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="ticketDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="ticketDescription" name="description" rows="8" required>{{ $ticket->description }}</textarea>
                        </div>
                        <input type="hidden" id="ticketId" name="id" value="{{ $ticket->id }}">
                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveTicketChanges()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


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

    <!-- script for handling the ticket details -->
    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            // Handle "Update Ticket" button click
            const updateTicketButton = document.getElementById('updateTicketButton');

            updateTicketButton.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default link behavior
                const updateTicketModal = new bootstrap.Modal(document.getElementById('updateTicketModal'));
                updateTicketModal.show(); // Show the modal
            });

            // Handle "Change Status" functionality
            const changeStatusButton = document.getElementById('changeStatusButton');
            const statusList = document.getElementById('statusList');
            const statusItems = statusList.querySelectorAll('.dropdown-item');

            // Show the status list when hovering over the "Change Status" button
            changeStatusButton.addEventListener('mouseenter', function () {
                statusList.classList.remove('d-none');
            });

            // Hide the status list after a short delay when the mouse leaves the button
            changeStatusButton.addEventListener('mouseleave', function () {
                setTimeout(() => {
                    if (!statusList.matches(':hover')) {
                        statusList.classList.add('d-none');
                    }
                }, 200);
            });

            // Ensure the status list stays visible when hovering over it
            statusList.addEventListener('mouseenter', function () {
                statusList.classList.remove('d-none');
            });

            // Hide the status list when the mouse leaves it
            statusList.addEventListener('mouseleave', function () {
                statusList.classList.add('d-none');
            });

           // Handle click events for each status item
            statusItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    const selectedStatus = item.textContent.trim();

                    // Display confirmation alert
                    if (confirm(`Are you sure you want to change the status to: ${selectedStatus}?`)) {
                        // Add your custom logic for changing the ticket status
                        updateTicketStatus(selectedStatus);
                    }
                });
            });

        });

        // Function to update the ticket status
        async function updateTicketStatus(status) {
            const ticketId = document.getElementById('ticketId').value; // Assuming there's a hidden input for ticket ID
            try {
                const response = await fetch(`/my-ticket/${ticketId}/change-status`, {
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
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert(`Failed to update status: ${result.message}`);
                }
            } catch (error) {
                console.error('Error updating status:', error);
                alert('An error occurred while updating the status.');
            }
        }


        // Function to save ticket changes
        async function saveTicketChanges() {
            const form = document.getElementById('updateTicketForm');
            const ticketId = document.getElementById('ticketId').value;

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries()); // Convert FormData to JSON

            try {
                const response = await fetch(`/my-ticket/${ticketId}/update`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message);
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert(result.message);
                }
            } catch (error) {
                console.error('Error updating ticket:', error);
                alert('An error occurred while updating the ticket.');
            }
        }
    </script>


    <script>
        $(document).ready(function(){
            $('.jspContainer').jScrollPane();
        });
    </script>


</body>
</html>