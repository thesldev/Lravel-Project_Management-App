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
                    <h1 class="h3 mb-4 text-gray-800">Add New Client</h1>

                    <div class="card shadow p-4">
                        <form method="post" action="{{ route('client.storeData') }}">
                            @csrf
                            @method('post')
                            
                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Client Name" />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Phone Field -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Contact Number" />
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Project Description Field -->
                            <div class="mb-3">
                                <label for="project_description" class="form-label">Client Project's Description</label>
                                <textarea name="project_description" id="project_description" class="form-control" placeholder="Enter Project Description"></textarea>
                                @error('project_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Portal Access Field -->
                            <div class="form-check mb-3">
                                <input 
                                    type="checkbox" 
                                    name="portal_access" 
                                    id="portal_access" 
                                    class="form-check-input"
                                />
                                <label for="portal_access" class="form-check-label">Grant Portal Access</label>
                                @error('portal_access')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Submit and Cancel Buttons -->
                            <div class="d-flex gap-2">
                                <!-- Submit Button -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Add New Client</button>
                                </div>
                                <!-- Cancel Button -->
                                <div class="mb-3">
                                    <a href="" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
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

    <x-logoutModule />

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

</body>

</html>
