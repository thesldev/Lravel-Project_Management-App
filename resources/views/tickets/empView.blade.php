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

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

    <!-- jQuery (necessary for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <h1 class="h3 mb-4 text-gray-800">Ticket  #{{ $ticket->id }} Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Ticket {{ $ticket->id }} Information | Created At: {{ $ticket->created_at }}</h6>
                            
                        </div>
                        <!-- display ticket data -->
                        <div class="card-body">
                            <div class="row">
                                <!-- Ticket Title -->
                                <p><strong>Ticket Title:</strong> {{ $ticket->title }}</p>

                                <!-- Ticket Priority -->
                                <div class="col-md-3 me-3 ">
                                    <p><strong>Ticket Priority:</strong> {{ $ticket->priority }}</p>
                                </div>

                                <!-- Ticket Type -->
                                <div class="col-md-3 me-3">
                                    <p><strong>Ticket Type:</strong> {{ $ticket->type->name }}</p>
                                </div>

                                <!-- Ticket Status -->
                                <div class="col-md-3 me-3">
                                    <p><strong>Ticket Status:</strong> {{ $ticket->status->name }}</p>
                                </div>
                            </div>

                            <!-- Remaining Ticket Details -->
                            <div class="mt-2">    
                                <p class="mb-3">Created By: <strong>{{ $ticket->reporter->name }}</strong></p>
                                <p class="mb-3">Ticket Description: <strong>{{ $ticket->description }}</strong></p>
                                <p class="mb-3">
                                    Project Name: <strong>{{ $ticket->project->name }}</strong>
                                    <span class="mx-3">|</span>
                                    Priority: <strong>{{ $ticket->project->priority }}</strong>
                                </p>
                                <p class="mb-3">Due Date: <strong>{{ $ticket->due_date }}</strong></p>
                            </div>

                            <div class="row">
                                <div class="col-md-6 me-3">
                                    <p>
                                        Assign to: <strong>{{ $ticket->assignee->name }}</strong>
                                        <span class="mx-3">
                                    </p>
                                </div>
                                <div class="col-md-3 me-3">
                                    <p>Due Date: <strong>{{ $ticket->due_date }}</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <h6 class="mb-3">Add a Comment:</h6>
                                <div class="input-group">
                                    <textarea class="form-control" id="commentInput" placeholder="Write your comment here..." rows="2"></textarea>
                                    <button class="btn btn-primary" id="submitComment" type="button">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ticket history section -->
                    <h1 class="h3 mb-4 text-gray-800">Ticket #{{ $ticket->id }} History</h1>

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


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome (optional, for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</body>
</html>