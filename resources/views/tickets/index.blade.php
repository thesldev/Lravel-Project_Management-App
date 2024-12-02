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
     <link href="css/sb-admin-2.min.css" rel="stylesheet" />
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
                        <h1 class="h3 mb-2 text-gray-800">Tickets</h1>
                        
                        <div class="ms-auto">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTicketModal">Create Ticket</button>
                        </div>
                    </div>

                    <div class="container mt-4">
                        <!-- Ticket List -->
                        <div class="row">
                            <!-- Dynamic Tickets -->
                            <!-- Add dynamically generated tickets here -->
                        </div>
                    </div>


                    <!-- Create Ticket Modal -->
                    <div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby="createTicketModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createTicketModalLabel">Create Ticket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="/tickets/create-ticket">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Form fields as provided -->
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="priority" class="form-label">Priority</label>
                                            <select class="form-select" id="priority" name="priority" required>
                                                <option value="Low">Low</option>
                                                <option value="Medium" selected>Medium</option>
                                                <option value="High">High</option>
                                                <option value="Critical">Critical</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status_id" class="form-label">Ticket Status</label>
                                            <select class="form-select" id="status_id" name="status_id" required>
                                                <!-- Options populated dynamically by AJAX -->
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="type_id" class="form-label">Ticket Type</label>
                                            <select class="form-select" id="type_id" name="type_id" required>
                                                <!-- Options populated dynamically by AJAX -->
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="reporter_id" class="form-label">Reporter</label>
                                            <div class="form-control bg-light" id="reporter_id" readonly>
                                                {{ Auth::user()->name }}
                                            </div>
                                            <input type="hidden" name="reporter_id" value="{{ Auth::user()->id }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="assignee_id" class="form-label">Assignee</label>
                                            <select class="form-select" id="assignee_id" name="assignee_id">
                                                <!-- Fetch assignees dynamically -->
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="project_id" class="form-label">Project</label>
                                            <select class="form-select" id="project_id" name="project_id">
                                                <!-- Options populated dynamically by AJAX -->
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="due_date" class="form-label">Due Date</label>
                                            <input type="date" class="form-control" id="due_date" name="due_date">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
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
    
    <!-- Ajax & Jquery for create tickets -->
    <script>
        // fetch values for assignee drop down
        $.ajax({
                url: '/api/employees', // Updated URL for employee data
                method: 'GET',
                success: function(employees) {
                    let assigneeDropdown = $('#assignee_id');
                    assigneeDropdown.empty();
                    assigneeDropdown.append('<option value="">Select Assignee</option>');


                    if (employees && employees.length > 0) {
                        employees.forEach(function(employee) {
                            assigneeDropdown.append('<option value="' + employee.id + '">' + employee.name + '</option>');
                        });
                    } else {
                        console.warn('No employees returned by the API.');
                    }
                },
                error: function(error) {
                    console.error('Error fetching employees:', error);
                    alert('Failed to fetch employee data. Please try again later.');
                }
            });


        // fetch values for project data
        $.ajax({
            url: '/api/projects',
            method: 'GET',
            success: function(data) {
                let statustDropdown = $('#project_id');
                pstatusDropdown.empty();
                pstatusDropdown.append('<option value="">Select Project</option>');
                data.forEach(function(project) {
                    pstatusDropdown.append('<option value="' + project.id + '">' + project.name + '</option>');
                });
            },
            error: function(error) {
                console.error('Error fetching projects:', error);
            }
        });
        

        // Fetch ticket types
        $.ajax({
            url: '/api/ticketType',
            method: 'GET',
            success: function(data) {
                let typeDropdown = $('#type_id');
                typeDropdown.empty();
                typeDropdown.append('<option value="">Select Type</option>');
                data.forEach(function(ticketType) {
                    typeDropdown.append('<option value="' + ticketType.id + '">' + ticketType.name + '</option>');
                });
            },
            error: function(error) {
                console.error('Error fetching ticket types:', error);
            }
        });

        // Fetch ticket statuses
        $.ajax({
            url: '/api/ticketStatuses',
            method: 'GET',
            success: function(data) {
                let statusDropdown = $('#status_id');
                statusDropdown.empty();
                statusDropdown.append('<option value="">Select Status</option>');
                data.forEach(function(ticketStatus) {
                    statusDropdown.append('<option value="' + ticketStatus.id + '">' + ticketStatus.name + '</option>');
                });
            },
            error: function(error) {
                console.error('Error fetching ticket statuses:', error);
            }
        });

        // Fetch project data
        $.ajax({
            url: '/api/projects',
            method: 'GET',
            success: function(data) {
                let projectDropdown = $('#project_id');
                projectDropdown.empty();
                projectDropdown.append('<option value="">Select Project</option>');
                data.forEach(function(project) {
                    projectDropdown.append('<option value="' + project.id + '">' + project.name + '</option>');
                });
            },
            error: function(error) {
                console.error('Error fetching projects:', error);
            }
        });


        // Fetch all ticket details
        $.ajax({
            url: '/api/projects',
            method: 'GET',
            success: function(data) {
                let projectDropdown = $('#project_id');
                projectDropdown.empty();
                projectDropdown.append('<option value="">Select Project</option>');
                data.forEach(function(project) {
                    projectDropdown.append('<option value="' + project.id + '">' + project.name + '</option>');
                });
            },
            error: function(error) {
                console.error('Error fetching projects:', error);
            }
        });

    </script>

    <!-- Ajax & Jquery for handle ticket functions -->
    <script>
        // Fetch all ticket details
        $.ajax({
            url: '/tickets/all',
            method: 'GET',
            success: function(tickets) {
                let container = $('.row');
                container.empty(); // Clear any existing content

                tickets.forEach(ticket => {
                    // Format the created date
                    const createdDate = new Date(ticket.created_at);
                    const formattedDate = `${createdDate.getFullYear()}.${('0' + (createdDate.getMonth() + 1)).slice(-2)}.${('0' + createdDate.getDate()).slice(-2)}`;

                    // Get related data
                    const ticketType = ticket.type ? ticket.type.name : 'Unknown';
                    const ticketPriority = ticket.priority;
                    const projectName = ticket.project ? ticket.project.name : 'Unknown';
                    const ticketStatus = ticket.status ? ticket.status.name : 'Unknown';
                    const assigneeName = ticket.assignee ? ticket.assignee.name : 'Unknown';
                    const assigneeRole = ticket.assignee ? ticket.assignee.job_role : 'Unknown';

                    // Header part
                    let headerHTML = `
                        <div class="card-body pt-3 pb-1"> <!-- Reduced padding -->
                            <h6 class="card-title">
                                Created By: <span class="fw-bold">${ticket.reporter ? ticket.reporter.name : 'Unknown'}</span>
                                | At: <span class="fw-bold">${formattedDate}</span>
                                <span class="float-end">${ticketType} | ${ticketPriority}</span>
                            </h6>
                        </div>
                    `;

                    // Body part with flex layout for alignment and reduced margin
                    let bodyHTML = `
                        <div class="card-body pt-1 pb-3"> <!-- Reduced padding -->
                            <h5 class="card-title">${ticket.title}</h5>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><strong>Project:</strong> ${projectName}</span>
                                <a class="btn btn-primary btn-sm d-flex align-items-center justify-content-center" style="height: 40px;" href="/tickets/${ticket.id}/view">View Ticket</a> <!-- Use dynamic ticket ID -->
                            </div>
                            <p class="card-text mb-1"> <!-- Reduced margin -->
                                <strong>Status:</strong> ${ticketStatus}
                            </p>
                        </div>
                    `;
                    
                    // Footer part (keep as it is)
                    let footerHTML = `
                        <div class="card-footer d-flex justify-content-between">
                            <span><strong>Due Date:</strong> ${ticket.due_date}</span>
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

                    container.append(ticketHTML);
                });
            },
            error: function(error) {
                console.error('Error fetching tickets:', error);
            }
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
