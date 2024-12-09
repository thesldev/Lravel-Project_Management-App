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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


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
                        <h1 class="h3 mb-2 text-gray-800">Sprints History</h1>
                    </div>
                    <!-- issues in sprint -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Project List</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <ul id="project-list" class="list-group">
                                    @foreach($projects as $project)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <span class="me-2">Project Name:</span>
                                            <span>{{ $project->name }}</span>
                                            <!-- Icon between project name and client name -->
                                            <i class="bi bi-dash-lg mx-2" style="transform: rotate(90deg);"></i>
                                            <span class="me-2">Client:</span>
                                            <span>{{ $project->client->name }}</span>
                                        </div>
                                        <span class="d-flex gap-3 align-items-center">
                                            <span class="badge bg-info">{{ $project->status }}</span>
                                            <!-- Dropdown button for actions -->
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton{{ $project->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-info-lg"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $project->id }}">
                                                    <li>
                                                        <button class="dropdown-item btn-view" data-id="{{ $project->id }}"onclick="window.location.href='{{ route('history.projectHistory', ['id' => $project->id]) }}'">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="ms-2">View</span>
                                                        </button>
                                                    </li>                      
                                                </ul>
                                            </div>
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
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

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>


</body>

</html>
