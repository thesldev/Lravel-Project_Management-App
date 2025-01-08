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
    <!-- Include Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

     <!-- Custom styles for this template-->
     <link href="css/sb-admin-2.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="css/sb-admin-2.css">
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Client Tickets</h1>                  
                        <div class="ms-auto">
                            <div class="d-flex align-items-center dropdown">
                                <span class="me-2 text-muted fw-bold">Ticket Status</span>
                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <button class="dropdown-item filter-button" data-status="all">
                                            <i class="bi bi-list"></i> All
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item filter-button" data-status="Open">
                                            <i class="bi bi-folder2-open"></i> Open
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item filter-button" data-status="In Progress">
                                            <i class="bi bi-arrow-repeat"></i> In Progress
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item filter-button" data-status="On Hold">
                                            <i class="bi bi-pause-circle"></i> On Hold
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item filter-button" data-status="Resolved">
                                            <i class="bi bi-check-circle"></i> Resolved
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-4">
                        <!-- Ticket List -->
                        <div class="row">
                            <!-- Dynamic Tickets -->
                            <!-- Add dynamically generated tickets here -->
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

    
    <!-- Jquey scripts for fetch project and employee data -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    <!-- Ajax & jQuery for handling ticket functions -->
    <script>
        function fetchTickets(status = 'all') {
            // Determine the API endpoint based on the selected status
            const url = status === 'all' ? '/client-tickets/all' : `/client-tickets/status/${status}`;

            $.ajax({
                url: url,
                method: 'GET',
                success: function (tickets) {
                    let container = $('.row');
                    container.empty(); // Clear existing tickets

                    // Display a message if no tickets are found
                    if (tickets.length === 0) {
                        container.append('<p class="text-center">No tickets found for the selected status.</p>');
                        return;
                    }

                    // Iterate through the tickets and generate HTML for each
                    tickets.forEach(ticket => {
                        const createdDate = new Date(ticket.created_at);
                        const formattedDate = `${createdDate.getFullYear()}.${('0' + (createdDate.getMonth() + 1)).slice(-2)}.${('0' + createdDate.getDate()).slice(-2)}`;

                        // Generate the status badge with appropriate styling
                        const statusBadge = `
                            <span class="badge ${
                                ticket.status === 'Open' ? 'bg-primary' :
                                ticket.status === 'In Progress' ? 'bg-info text-dark' :
                                ticket.status === 'On Hold' ? 'bg-warning text-dark' :
                                ticket.status === 'Resolved' ? 'bg-success' :
                                'bg-secondary'
                            }">
                                ${ticket.status || 'Unknown'}
                            </span>
                        `;

                        // Generate the priority badge with appropriate styling
                        const priorityBadge = `
                            <span class="badge ${
                                ticket.priority === 'Critical' ? 'bg-danger' :
                                ticket.priority === 'High' ? 'bg-warning text-dark' :
                                ticket.priority === 'Medium' ? 'bg-primary' :
                                'bg-secondary'
                            }">
                                ${ticket.priority || 'Unknown'}
                            </span>
                        `;

                        // Create the ticket card HTML
                        const ticketHTML = `
                            <div class="col-md-6 col-lg-12 mb-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body pt-3 pb-1">
                                        <h6 class="card-title">
                                            Created By: <span class="fw-bold">${ticket.client ? ticket.client.name : 'Unknown'}</span>
                                            | At: <span class="fw-bold">${formattedDate}</span>
                                            <span class="float-end">${ticket.type?.name || 'Unknown'} | ${priorityBadge}</span>
                                        </h6>
                                    </div>
                                    <div class="card-body pt-1 pb-3">
                                        <h5 class="card-title">${ticket.title}</h5>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span><strong>Project:</strong> ${ticket.project?.name || 'Unknown'}</span>
                                            <a class="btn btn-primary btn-sm" href="/tickets/${ticket.id}/view">View Ticket</a>
                                        </div>
                                        <p class="card-text mb-1"><strong>Status:</strong> ${statusBadge}</p>
                                    </div>
                                </div>
                            </div>
                        `;

                        container.append(ticketHTML); // Add the ticket card to the container
                    });
                },
                error: function (error) {
                    console.error('Error fetching tickets:', error);
                }
            });
        }

        // Fetch all tickets when the page loads
        fetchTickets();

        // Filter tickets by status when a dropdown item is clicked
        $(document).on('click', '.filter-button', function () {
            const status = $(this).data('status'); // Get the status from the clicked button's data attribute
            fetchTickets(status); // Fetch tickets with the selected status
        });
    </script>

    
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

    <!-- jQuery (necessary for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
