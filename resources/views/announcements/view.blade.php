<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>View Announcement - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
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
                    <h1 class="h3 mb-4 text-gray-800">Announcement Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Announcement #{{ $announcements->id }} Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Announcement ID:</strong> {{ $announcements->id }}</p>
                            <p><strong>Created By:</strong> {{ $announcements->creator->name }}</p>
                            <p><strong>Creator Email:</strong> {{ $announcements->creator_email }}</p>
                            <p><strong>Title:</strong> {{ $announcements->title }}</p>
                            <p><strong>Description:</strong> {{ $announcements->body }}</p>
                            <p><strong>Priority:</strong> {{ $announcements->priority }}</p>
                            <p><strong>Related Service:</strong> {{ $announcements->service }}</p>
                            <p><strong>Created At:</strong> {{ $announcements->created_at }}</p>
                            <p><strong>updated At:</strong> {{ $announcements->updated_at }}</p>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Client Portal-Access</h6>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#editModal" style="margin-right: 10px;">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Edit</span>
                        </button>

                        <form action="{{ route('announcement.deleteData', $announcements->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Are you sure you want to delete this announcement?');">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Delete</span>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('announcement.update', $announcements->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Announcement #{{ $announcements->id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $announcements->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="body" id="body" class="form-control" rows="5" required>{{ $announcements->body }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority" class="form-control" required>
                                <option value="low" {{ $announcements->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $announcements->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $announcements->priority == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="service">Related Service</label>
                            <input type="text" name="service" id="service" class="form-control" value="{{ $announcements->service }}" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
