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
                        <h1 class="h3 mb-2 text-gray-800">Manage Sprints</h1>
                        <form action="{{ route('sprint.generateReport') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Generate Report</button>
                        </form>

                    </div>
                    
                    <div class="container mt-4">
                        <div class="row">
                            @foreach($sprints as $sprint)
                                <!-- Sprint Card -->
                                <div class="col-md-6 col-lg-12 mb-4">
                                    <div class="card shadow-sm border-0">
                                        <!-- Header Part -->
                                        <div class="card-body pt-3 pb-1">
                                            <h6 class="card-title">
                                                Created By: <span class="fw-bold">{{ $sprint->created_by ?? 'Unknown' }}</span>
                                                | At: <span class="fw-bold">{{ \Carbon\Carbon::parse($sprint->created_at)->format('Y.m.d') }}</span>
                                                <span class="float-end">
                                                    Duration: {{ $sprint->duration_weeks }} weeks
                                                </span>
                                            </h6>
                                        </div>

                                        <!-- Body Part -->
                                        <div class="card-body pt-1 pb-3">
                                            <h5 class="card-title">{{ $sprint->title }}</h5>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span><strong>Project:</strong> {{ $sprint->project->name ?? 'Unknown' }}</span>
                                                <a class="btn btn-primary btn-sm d-flex align-items-center justify-content-center" style="height: 40px;" href="{{ route('sprint.manage', $sprint->id) }}">View Sprint</a>
                                            </div>
                                            <p class="card-text mb-1">
                                                <strong>Description:</strong> {{ $sprint->description }}
                                            </p>
                                        </div>

                                        <!-- Footer Part -->
                                        <div class="card-footer d-flex justify-content-between">
                                            <span><strong>Start Date:</strong> {{ $sprint->start_date }}</span>
                                            <span><strong>End Date:</strong> {{ $sprint->end_date }}</span>
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
