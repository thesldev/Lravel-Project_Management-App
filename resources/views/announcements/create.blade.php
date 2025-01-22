<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Create Announcement - Admin Dashboard</title>

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
                    <h1 class="h3 mb-4 text-gray-800">New Announcement</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Create New Announcement</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('announcements.store') }}" method="POST">
                                @csrf
                                <!-- Hidden fields for logged-in user's ID and email -->
                                <input type="hidden" name="created_by" value="{{ Auth::id() }}">
                                <input type="hidden" name="creator_email" value="{{ Auth::user()->email }}">

                                <!-- Title -->
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input 
                                        type="text" 
                                        name="title" 
                                        id="title" 
                                        class="form-control" 
                                        placeholder="Enter the title of the announcement" 
                                        required>
                                </div>

                                <!-- Body -->
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea 
                                        name="body" 
                                        id="body" 
                                        class="form-control" 
                                        rows="4" 
                                        placeholder="Enter the content of the announcement" 
                                        required></textarea>
                                </div>

                                <!-- Priority -->
                                <div class="form-group">
                                    <label for="priority">Priority</label>
                                    <select 
                                        name="priority" 
                                        id="priority" 
                                        class="form-control" 
                                        required>
                                        <option value="" disabled selected>Select priority</option>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>

                                <!-- Service -->
                                <div class="form-group">
                                    <label for="service">Service</label>
                                    <select 
                                        name="service" 
                                        id="service" 
                                        class="form-control" 
                                        required>
                                        <option value="" disabled selected>Select a service</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Create Announcement</button>
                            </form>
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



</body>

</html>
