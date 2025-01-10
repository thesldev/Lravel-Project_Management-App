<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>View Client - Admin Dashboard</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Client Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Client Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>ID:</strong> {{ $client->id }}</p>
                            <p><strong>Name:</strong> {{ $client->name }}</p>
                            <p><strong>Email:</strong> {{ $client->email }}</p>
                            <p><strong>Phone:</strong> {{ $client->phone }}</p>
                            <p><strong>Description:</strong> {{ $client->project_description }}</p>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Client Portal-Access</h6>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <p style="margin: 0;">
                                    <strong>Portal-Access:</strong> 
                                    <span id="portal-status">{{ $client->portal_access == 1 ? 'Enable' : 'Disable' }}</span>
                                </p>
                                <p>
                                    <span>Change Portal Access: </span>
                                    <button class="btn btn-link" id="toggle-access" onclick="togglePortalAccess('{{ $client->id }}')">
                                        <i class="bi {{ $client->portal_access == 1 ? 'bi-toggle-on' : 'bi-toggle-off' }}"></i>
                                    </button>
                                </p>        
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div>
                        <!-- Edit Button -->
                        <a href="{{ route('client.editData', ['client' => $client]) }}" class="btn btn-warning btn-icon-split" style="margin-right: 10px;">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Edit</span>
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('client.deleteData', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Are you sure you want to delete this client?');">
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

    <script>
    function togglePortalAccess(clientId) {
        fetch(`/toggle-portal-access/${clientId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const portalStatus = document.getElementById('portal-status');
                const toggleIcon = document.querySelector('#toggle-access i');

                // Update the portal status and toggle icon
                if (data.portal_access == 1) {
                    portalStatus.textContent = 'Enable';
                    toggleIcon.classList.remove('bi-toggle-off');
                    toggleIcon.classList.add('bi-toggle-on');
                } else {
                    portalStatus.textContent = 'Disable';
                    toggleIcon.classList.remove('bi-toggle-on');
                    toggleIcon.classList.add('bi-toggle-off');
                }
            } else {
                alert('Failed to update portal access');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

</body>

</html>
