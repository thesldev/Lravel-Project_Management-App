<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Service Details - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <!-- Include Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

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
                    <h1 class="h3 mb-4 text-gray-800">Service Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Client Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Service ID:</strong> {{ $service->id }}</p>
                            <p><strong>Name:</strong> {{ $service->name }}</p>
                            <p><strong>Description:</strong> {{ $service->description }}</p>
                            <p><strong>Service Type:</strong> {{ $service->service_type	 }}</p>
                            <p><strong>Status:</strong> {{ $service->status }}</p>
                            <p><strong>Priority:</strong> {{ $service->priority }}</p>
                            <p><strong>Started Date:</strong> {{ $service->start_date }}</p>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $service->name }} Users:</h6>
                            <!-- Add Users Button -->
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUsersModal">Add Users</button>
                        </div>
                        <div class="card-body">
                            @if($service->users->isEmpty())
                                <p class="text-muted">No users have been assigned to this service yet.</p>
                            @else
                                <ul class="list-group"> 
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact No</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($service->users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->client->phone }}</td>
                                                    <td>
                                                        <!-- View Action Button -->
                                                        <a href="{{ route('service.view', ['id' => $service]) }}" class="btn btn-primary btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-eye"></i>
                                                            </span>
                                                            <span class="text">View</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact No</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div>
                        <!-- Edit Button -->
                        <a href="" class="btn btn-warning btn-icon-split" style="margin-right: 10px;">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Edit</span>
                        </a>

                        
                        <form action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Are you sure you want to delete this client?');">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Remove</span>
                            </button>
                        </form>
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

    <!-- Add Users Modal -->
    <div class="modal fade" id="addUsersModal" tabindex="-1" aria-labelledby="addUsersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUsersModalLabel">Add Users to {{$service->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('service.addUsers', $service->id) }}" method="POST">
                        @csrf
                        <!-- Clients List -->
                        <div class="mb-3">
                            <label for="clientSelect" class="form-label">Select Clients</label>
                            <select name="clients[]" id="clientSelect" class="form-select" multiple style="width: 100%;">
                                @foreach($clients as $client)
                                    <option value="{{ $client->user_id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-muted">Hold down the Ctrl (Windows) or Command (Mac) key to select multiple clients.</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Selected Users</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- jQuery (necessary for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#clientSelect').select2({
                placeholder: "Select Clients",
                allowClear: true
            });
        });

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
