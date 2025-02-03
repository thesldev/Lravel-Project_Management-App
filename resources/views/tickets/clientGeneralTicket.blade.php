<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>General Tickets - Admin Dashboard</title>

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
                        <h1 class="h3 mb-2 text-gray-800">General Tickets</h1>                  
                    </div>

                    <!-- display active tickets -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Handle General Tickets (Active)</h6>

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
                            <div class="row active-tickets-container">
                               
                            </div>
                        </div>
                    </div> 
                    
                    <!-- display closed or resolved tickets -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Handle General Tickets (Closed & Resolved)</h6>
                        </div>
                        <!-- display ticket data -->
                        <div class="card-body">
                            <div class="row closed-resolved-tickets-container">
                               
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

    <!-- Ajax & jQuery for handling ticket functions -->
    <script>
        $(document).ready(function () {
            fetchTickets();
            fetchClosedResolvedTickets();
        });

        function fetchTickets() {
            $.ajax({
                url: '/client-general-tickets/all',
                method: 'GET',
                success: function (tickets) {
                    let container = $('.active-tickets-container');
                    container.empty();
                    
                    let activeTickets = tickets.filter(ticket => ['open', 'in-progress', 'on-hold'].includes(ticket.status));
                    
                    if (activeTickets.length === 0) {
                        container.append('<p class="text-center">No active tickets found.</p>');
                        return;
                    }

                    activeTickets.forEach(ticket => {
                        container.append(generateTicketHTML(ticket));
                    });
                },
                error: function (error) {
                    console.error('Error fetching active tickets:', error);
                }
            });
        }

        function fetchClosedResolvedTickets() {
            $.ajax({
                url: '/client-general-tickets/closed-or-resolved',
                method: 'GET',
                success: function (tickets) {
                    let container = $('.closed-resolved-tickets-container');
                    container.empty();
                    
                    let closedTickets = tickets.filter(ticket => ['closed', 'resolved'].includes(ticket.status));
                    
                    if (closedTickets.length === 0) {
                        container.append('<p class="text-center">No closed or resolved tickets found.</p>');
                        return;
                    }

                    closedTickets.forEach(ticket => {
                        container.append(generateTicketHTML(ticket));
                    });
                },
                error: function (error) {
                    console.error('Error fetching closed or resolved tickets:', error);
                }
            });
        }

        function generateTicketHTML(ticket) {
            const createdDate = new Date(ticket.created_at);
            const formattedDate = `${createdDate.getFullYear()}.${('0' + (createdDate.getMonth() + 1)).slice(-2)}.${('0' + createdDate.getDate()).slice(-2)}`;
            
            const statusBadge = `<span class="badge ${getStatusClass(ticket.status)}">${ticket.status || 'Unknown'}</span>`;
            const priorityBadge = `<span class="badge ${getPriorityClass(ticket.priority)}">${ticket.priority || 'Unknown'}</span>`;
            
            return `
                <div class="col-md-6 col-lg-12 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body pt-3 pb-1">
                            <h6 class="card-title">
                                Created By: <span class="fw-bold">${ticket.client?.name || 'Unknown'}</span>
                                | At: <span class="fw-bold">${formattedDate}</span>
                                <span class="float-end"> Priority : ${priorityBadge}</span>
                            </h6>
                        </div>
                        <div class="card-body pt-1 pb-3">
                            <h5 class="card-title">${ticket.subject}</h5>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><strong>Description:</strong> ${ticket.description || 'No Description'}</span>
                                <a class="btn btn-primary btn-sm" href="/client-tickets/${ticket.id}/view">View Ticket</a>
                            </div>
                            <p class="card-text mb-1"><strong>Status:</strong> ${statusBadge}</p>
                        </div>
                    </div>
                </div>
            `;
        }

        function getStatusClass(status) {
            switch (status) {
                case 'Open': return 'bg-primary';
                case 'In Progress': return 'bg-info text-dark';
                case 'On Hold': return 'bg-warning text-dark';
                case 'Resolved': return 'bg-success';
                case 'Closed': return 'bg-secondary';
                default: return 'bg-dark';
            }
        }

        function getPriorityClass(priority) {
            switch (priority) {
                case 'Critical': return 'bg-danger';
                case 'High': return 'bg-warning text-dark';
                case 'Medium': return 'bg-primary';
                default: return 'bg-secondary';
            }
        }
    </script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
