<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SB Admin 2 - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
     
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/client-portal-project-card.css') }}" rel="stylesheet" />
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
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">My Projects</h1>

                    <p class="mb-4">Here is a list of projects with the respective details. You can view & change details by clicking the "View" button in Action column.</p>
                    <!-- DataTales Example -->
                    <div class="container py-4">
                        <div class="row">
                            @foreach ($projects as $project)
                                <div class="col-12 mb-3">
                                    <div class="card project-card shadow-sm">
                                        <!-- Header Section -->
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <h5 class="mb-0 me-2">{{ $project->name }}</h5> 
                                                <span class="badge bg-primary">#{{ $project->id }}</span>
                                            </div>
                                        </div>

                                        <!-- Body Section -->
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="flex-grow-1">
                                                <p class="card-text mb-1">
                                                    {{ $project->description }}
                                                </p>
                                            </div>

                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#issuesModal">
                                                            <i class="bi bi-info-lg"></i> Info
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Footer Section -->
                                        <div class="card-footer d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="text-muted" style="font-size: 0.9rem;">
                                                    <strong>Start Date:</strong> {{ $project->start_date }} |
                                                    <strong>End Date:</strong> {{ $project->end_date }}
                                                </span>
                                            </div>

                                            <div>
                                                <span class="badge {{ $project->status === 'Completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ $project->status }}
                                                </span>
                                            </div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
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

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
