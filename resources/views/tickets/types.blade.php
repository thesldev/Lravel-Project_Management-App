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
                    <h1 class="h3 mb-2 text-gray-800">Ticket Types</h1>

                    <p class="mb-4">Here is a list of ticket Types available in the database. You can create new ticket types by clicking 'Create Type' button.</p>
                    
                    <!-- Create Ticket Button -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTicketModal">Create Type</button>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ticket Types Table</h6>
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

    <!-- Create Ticket Type Modal -->
    <div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby="createTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTicketModalLabel">Create Ticket Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createTicketTypeForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Type Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Ticket Type Modal -->
    <div class="modal fade" id="editTicketTypeModal" tabindex="-1" aria-labelledby="editTicketTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTicketTypeModalLabel">Edit Ticket Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTicketTypeForm">
                        <div class="mb-3">
                            <label for="editTypeName" class="form-label">Type Name</label>
                            <input type="text" class="form-control" id="editTypeName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTypeDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editTypeDescription" name="description"></textarea>
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

    <!-- Ajax & Jquery functions for handle type's crud operations -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function () {

        // Create Ticket Type
        $('#createTicketTypeForm').submit(function (e) {
            e.preventDefault();

            // Collect form data
            let formData = {
                name: $('#name').val(),
                description: $('#description').val(),
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
            };

            // AJAX request to create ticket type
            $.ajax({
                url: '/ticket-types',
                type: 'POST',
                data: formData,
                success: function (response) {
                    alert(response.message);
                    $('#createTicketModal').modal('hide');
                    $('#createTicketTypeForm')[0].reset();
                    // Refresh or update the ticket type list dynamically
                    loadTicketTypes();
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.responseJSON.message);
                },
            });
        });

        // Load Ticket Types (for dynamically updating the UI)
        function loadTicketTypes() {
            $.ajax({
                url: '/ticket-type', // Match the route correctly
                type: 'GET',
                success: function (response) {
                    let ticketTypeList = '';
                    response.forEach(function (type) {
                        ticketTypeList += `
                            <tr>
                                <td>${type.id}</td>
                                <td>${type.name}</td>
                                <td>${type.description}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm editTypeBtn" data-id="${type.id}" data-name="${type.name}" data-description="${type.description}">Edit</button>
                                    <button class="btn btn-danger btn-sm deleteTypeBtn" data-id="${type.id}">Delete</button>
                                </td>

                            </tr>
                        `;
                    });
                    // Add the generated rows to the table body with id 'dataTable'
                    $('#dataTable tbody').html(ticketTypeList);
                    $('#dataTable').DataTable(); // Reinitialize DataTable if needed
                },
                error: function () {
                    alert('Error loading ticket types.');
                },
            });
        }


        // Delete Ticket Type
        $(document).on('click', '.deleteTypeBtn', function () {
            let typeId = $(this).data('id'); // Fetch the ID from the button
            if (confirm('Are you sure you want to delete this ticket type?')) {
                $.ajax({
                    url: `/ticket-types/${typeId}`,
                    type: 'DELETE',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        alert(response.message);
                        loadTicketTypes();
                    },
                    error: function (xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    },
                });
            }
        });


        // Handle Edit Ticket Type (Modal Form)
        $(document).on('click', '.editTypeBtn', function () {
            let typeId = $(this).data('id');
            $('#editTypeName').val($(this).data('name'));
            $('#editTypeDescription').val($(this).data('description'));
            $('#editTicketTypeModal').modal('show');

            $('#editTicketTypeForm').off('submit').submit(function (e) {
                e.preventDefault();

                let formData = {
                    name: $('#editTypeName').val(),
                    description: $('#editTypeDescription').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                };

                let typeId = $('.editTypeBtn').data('id'); // Fetch the ID dynamically
                $.ajax({
                    url: `/ticket-types/${typeId}`,
                    type: 'PUT',
                    data: formData,
                    success: function (response) {
                        alert(response.message);
                        $('#editTicketTypeModal').modal('hide');
                        loadTicketTypes();
                    },
                    error: function (xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    },
                });
            });

        });

        // Initial load of ticket types
        loadTicketTypes();
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
