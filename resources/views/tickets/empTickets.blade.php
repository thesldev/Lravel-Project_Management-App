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

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Include Sidebar -->
        <x-employee-side-bar />

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
                        <h1 class="h3 mb-2 text-gray-800">My Tickets</h1>
                    </div>

                    <div class="container mt-4">
                        <!-- Ticket List -->
                        <div id="ticketList" class="row">
                            @foreach($tickets as $ticket)
                                <script>
                                    // Safely pass PHP data to JavaScript
                                    let ticket = JSON.parse('@json($ticket)');

                                    // Format the date
                                    let createdAt = new Date(ticket.created_at).toLocaleString();
                                    let dueDate = new Date(ticket.due_date).toLocaleDateString();
                                    
                                    // Extract data from the ticket object with checks
                                    let reporterName = ticket.reporter ? ticket.reporter.name : 'Unknown';
                                    let ticketType = ticket.type ? ticket.type.name : 'N/A';
                                    let ticketPriority = ticket.priority ? ticket.priority : 'N/A';
                                    let projectName = ticket.project ? ticket.project.name : 'N/A';
                                    let ticketStatus = ticket.status ? ticket.status.name : 'N/A';
                                    let assigneeName = ticket.assignee ? ticket.assignee.name : 'N/A';
                                    let assigneeRole = ticket.assignee ? ticket.assignee.job_role : 'N/A';

                                    // Header part
                                    let headerHTML = `
                                        <div class="card-body pt-3 pb-1">
                                            <h6 class="card-title">
                                                Assigned By: <span class="fw-bold">${reporterName}</span>
                                                | At: <span class="fw-bold">${createdAt.replace(',', '&nbsp; |')}</span>
                                                <span class="float-end">${ticketType} | ${ticketPriority}</span>
                                            </h6>
                                        </div>
                                    `;
                                    // Body part with flex layout for alignment
                                    let bodyHTML = `
                                        <div class="card-body pt-1 pb-3">
                                            <h5 class="card-title">${ticket.title}</h5>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span><strong>Project:</strong> ${projectName}</span>
                                                <a class="btn btn-primary btn-sm d-flex align-items-center justify-content-center" style="height: 40px;" href="/tickets/${ticket.id}/view">View Ticket</a>
                                            </div>
                                            <p class="card-text mb-1">
                                                <strong>Status:</strong> ${ticketStatus}
                                            </p>
                                        </div>
                                    `;
                                    // Footer part
                                    let footerHTML = `
                                        <div class="card-footer d-flex justify-content-between">
                                            <span><strong>Due Date:</strong> ${dueDate}</span>
                                            <span><strong>Assignees:</strong> ${assigneeName} | <strong>Job Role:</strong> ${assigneeRole}</span>
                                        </div>
                                    `;

                                    // Combine all parts into a complete ticket card
                                    let ticketHTML = `
                                        <div class="col-md-6 col-lg-12 mb-4">
                                            <div class="card shadow-sm border-0">
                                                ${headerHTML}
                                                ${bodyHTML}
                                                ${footerHTML}
                                            </div>
                                        </div>
                                    `;

                                    // Append the ticket card to the ticket list container
                                    document.getElementById('ticketList').innerHTML += ticketHTML;
                                </script>
                            @endforeach
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

    <!-- Jquery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
