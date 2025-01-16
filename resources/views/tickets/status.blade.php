<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ticket Status - Admin Dashboard</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Ticket Statuses</h1>

                    <p class="mb-4">Here is a list of ticket Statuses available in the database. You can create new ticket statuses by clicking 'Create Statuses' button.</p>
                    
                    <!-- Create Ticket Button -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTicketModal">Create Statuses</button>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ticket Statuses Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Ticket Id</th>
                                            <th>Ticket Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Ticket Id</th>
                                            <th>Ticket Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
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

    <!-- Create Ticket Status Modal -->
    <div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby="createTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTicketModalLabel">Create Ticket Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createTicketStatusForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Status Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="is_final" class="form-label">Is Final?</label>
                            <select class="form-control" id="is_final" name="is_final">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Ticket status Modal -->
    <div class="modal fade" id="editTicketTypeModal" tabindex="-1" aria-labelledby="editTicketTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTicketTypeModalLabel">Edit Ticket Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTicketTypeForm">
                        <input type="hidden" id="editTicketStatusId">
                        <div class="mb-3">
                            <label for="editTypeName" class="form-label">Status Name</label>
                            <input type="text" class="form-control" id="editTypeName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" id="isFinal" name="is_final" value="1">
                            <label for="isFinal">Is Final</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   <!-- Ajax & Jquery functions for handle status's CRUD operations -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function () {

            // Create Ticket Status
            $('#createTicketStatusForm').submit(function (e) {
                e.preventDefault();

                // Collect form data
                let formData = {
                    name: $('#name').val(),
                    is_final: $('#is_final').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                };

                // AJAX request to create ticket status
                $.ajax({
                    url: '/ticket-status',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        alert(response.message);
                        $('#createTicketModal').modal('hide');
                        $('#createTicketStatusForm')[0].reset();
                        // Refresh or update the ticket status list dynamically
                        loadTicketStatuses();
                    },
                    error: function (xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    },
                });
            });

            // Load Ticket Statuses (for dynamically updating the UI)
            function loadTicketStatuses() {
                $.ajax({
                    url: '/ticket-statuses', // Route to fetch statuses
                    type: 'GET',
                    success: function (response) {
                        let ticketStatusList = '';
                        response.forEach(function (status) {
                            ticketStatusList += `
                                <tr>
                                    <td>${status.id}</td>
                                    <td>${status.name}</td>
                                    <td>${status.is_final ? 'Yes' : 'No'}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm editStatusBtn" data-id="${status.id}" data-name="${status.name}" data-is_final="${status.is_final}">Edit</button>
                                        <button class="btn btn-danger btn-sm deleteStatusBtn" data-id="${status.id}">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#dataTable tbody').html(ticketStatusList); // Update table body
                        $('#dataTable').DataTable(); // Reinitialize DataTable if needed
                    },
                    error: function () {
                        alert('Error loading ticket statuses.');
                    },
                });
            }


            // Delete Ticket Status
            $(document).on('click', '.deleteStatusBtn', function () {
                // Get the Ticket Status ID from the data attribute
                let statusId = $(this).data('id');

                // Confirm before deleting
                if (confirm('Are you sure you want to delete this ticket status?')) {
                    // AJAX request to delete the ticket status
                    $.ajax({
                        url: `/ticket-status/${statusId}`, // Corrected route
                        type: 'DELETE',                  // Ensure DELETE method
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Include CSRF token in headers
                        },
                        success: function (response) {
                            alert(response.message); // Show success message
                            loadTicketStatuses();   // Reload the table
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                            alert('Error: ' + (xhr.responseJSON.message || 'Unable to delete status.'));
                        },
                    });
                }
            });



            // Edit Ticket Status Button Click Event
            $(document).on('click', '.editStatusBtn', function () {
                let statusId = $(this).data('id');
                let name = $(this).data('name');
                let isFinal = $(this).data('is_final');

                // Populate the modal fields with existing data
                $('#editTicketTypeForm #editTicketStatusId').val(statusId);
                $('#editTicketTypeForm #editTypeName').val(name);
                $('#editTicketTypeForm #isFinal').prop('checked', isFinal);

                // Show the modal
                $('#editTicketTypeModal').modal('show');
            });

            // Form submission for editing a ticket status
            $('#editTicketTypeForm').submit(function (e) {
                e.preventDefault();
                let statusId = $('#editTicketStatusId').val();
                let formData = {
                    name: $('#editTypeName').val(),
                    is_final: $('#isFinal').prop('checked') ? 1 : 0,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                };

                $.ajax({
                    url: `/ticket-statuses/${statusId}`,
                    type: 'PUT',
                    data: formData,
                    success: function (response) {
                        alert(response.message);
                        $('#editTicketTypeModal').modal('hide');
                        loadTicketStatuses(); // Reload the table after successful update
                    },
                    error: function (xhr) {
                        alert('Error: ' + (xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An unexpected error occurred.'));
                    },
                });
            });



            // Initial load of ticket statuses
            loadTicketStatuses();
        });
    </script>

    <!-- Bootstrap core JavaScript-->
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
