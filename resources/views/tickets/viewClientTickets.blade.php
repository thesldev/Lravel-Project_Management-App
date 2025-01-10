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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/comments-styles.css') }}" rel="stylesheet" />
    <!-- jQuery (necessary for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet" />

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
                    <h1 class="h3 mb-4 text-gray-800">Client-Ticket  #{{ $ticket->id }} Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Ticket #{{ $ticket->id }} Information | Created At: {{ $ticket->created_at }}</h6>

                            <div class="dropdown">
                                <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item" id="assignMemberButton" data-bs-toggle="modal" data-bs-target="#assignMemberModal">
                                            <i class="bi bi-person-plus-fill"></i> Assign Member
                                        </a>
                                    </li>
                                    <li class="dropdown-item position-relative">
                                        <a id="changeStatusButton">
                                            <i class="bi bi-arrow-repeat"></i> Change Status
                                        </a>
                                        <!-- Status List -->
                                        <div id="statusList" class="status-popup position-absolute d-none">
                                            <ul class="list-unstyled mb-0">
                                                <li class="dropdown-item" data-status="Open">Open</li>
                                                <li class="dropdown-item" data-status="In Progress">In Progress</li>
                                                <li class="dropdown-item" data-status="On Hold">On Hold</li>
                                                <li class="dropdown-item" data-status="Resolved">Resolved</li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" id="closeTicketButton">
                                            <i class="bi bi-x-circle-fill"></i> Close Ticket
                                        </a>
                                    </li>
                                </ul>
                                <!-- Hidden input to store ticket ID -->
                                <input type="hidden" id="ticketId" name="id" value="{{ $ticket->id }}"><!-- Replace 12345 with dynamic ticket ID -->
                            </div>

                        </div>
                        <!-- display ticket data -->
                        <div class="card-body">
                            <div class="row">
                                <!-- Ticket Title -->
                                <p>Ticket Title: <strong>{{ $ticket->title }}</strong></p>

                                <!-- Ticket Priority -->
                                <div class="col-md-3 me-3">
                                    <p>Ticket Priority: 
                                        <span class="badge 
                                            {{ $ticket->priority === 'Critical' ? 'bg-danger' : '' }}
                                            {{ $ticket->priority === 'High' ? 'bg-warning text-dark' : '' }}
                                            {{ $ticket->priority === 'Medium' ? 'bg-primary' : '' }}
                                            {{ $ticket->priority === 'Low' ? 'bg-secondary' : '' }}">
                                            {{ $ticket->priority }}
                                        </span>
                                    </p>
                                </div>

                                <!-- Ticket Type -->
                                <div class="col-md-3 me-3">
                                    <p>Ticket Type:<strong></strong> </p>
                                </div>

                                <!-- Ticket Status -->
                                <div class="col-md-3 me-3">
                                    <p>Ticket Status: 
                                        <span class="badge 
                                            {{ $ticket->status === 'In Progress' ? 'bg-info text-dark' : '' }}
                                            {{ $ticket->status === 'On Hold' ? 'bg-warning text-dark' : '' }}
                                            {{ $ticket->status === 'Resolved' ? 'bg-success' : '' }}
                                            {{ $ticket->status === 'Closed' ? 'bg-danger' : '' }}
                                            {{ $ticket->status === 'Open' ? 'bg-secondary' : '' }}">
                                            {{ $ticket->status }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <!-- Remaining Ticket Details -->
                            <div class="mt-2">    
                                <p class="mb-3">Created By: <strong>{{ $ticket->client->name }}</strong></p>
                                <p class="mb-3">Ticket Description: <strong>{{ $ticket->description }}</strong></p>
                                <p class="mb-3">
                                    Project Name: <strong>{{ $ticket->project->name }}</strong>
                                    <span class="mx-3">|</span>
                                    Project Priority: 
                                    <strong>
                                        <span class="badge 
                                            @if($ticket->project->priority == 'Low') 
                                                bg-success 
                                            @elseif($ticket->project->priority == 'Medium') 
                                                bg-warning 
                                            @elseif($ticket->project->priority == 'High') 
                                                bg-danger 
                                            @endif
                                        ">
                                            {{ $ticket->project->priority }}
                                        </span>
                                    </strong>
                                </p>
                                <p class="mb-3">Due Date: <strong></strong></p>
                            </div>

                            <div class="row">
                                <div class="me-3">
                                    <p>
                                        Assign to: <strong>{{ $ticket->assignedUser->name ?? 'Not Assigned' }}</strong>
                                        <span class="mx-3">|</span> <!-- Add margin around the separator -->
                                        Job Role: <strong>{{ $ticket->assignedUser->job_role ?? 'Not Assigned' }}</strong>
                                        <span class="mx-3">|</span> <!-- Add margin around the separator -->
                                        Position: <strong>{{ $ticket->assignedUser->position ?? 'Not Assigned' }}</strong>
                                    </p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('comments.storeAdminComment', $ticket->id) }}">
                                @csrf
                                <div class="row mt-5">
                                    <h6 class="mb-3">Add a Comment:</h6>
                                    <div class="input-group">
                                        <textarea name="content" class="form-control" id="commentInput" placeholder="Write your comment here..." rows="2" required></textarea>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- ticket history section -->
                    <h1 class="h3 mb-4 text-gray-800">Ticket #{{ $ticket->id }} Comment History</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="ks-messages ks-messenger__messages">
                                <div
                                    class="ks-body ks-scrollable"
                                    style="height: 480px; overflow-y: auto; padding: 0;"
                                >
                                    <ul class="ks-items" id="comments-container">
                                        <!-- Comments will be dynamically injected here -->
                                    </ul>
                                </div>
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


    <!-- Modal -->
    <div class="modal fade" id="assignMemberModal" tabindex="-1" aria-labelledby="assignMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignMemberModalLabel">Assign Member to Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Display Already Assigned Members -->
                    <h6>Assigned Members:</h6>
                    <ul id="assignedMembersList">
                        @foreach ($ticket->project->employees as $employee)
                            <li>{{ $employee->name }} - {{ $employee->job_role }}</li>
                        @endforeach
                    </ul>

                    <!-- Select Member for the Support Ticket -->
                    <form method="POST" action="{{ route('assign.assignMember', $ticket->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="employeeSelect" class="form-label">Select Member for Support Ticket</label>
                            <select class="form-select" id="employeeSelect" name="employee_id" required>
                                <option value="" disabled selected>Select an employee</option>
                                @foreach ($ticket->project->employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }} - {{ $employee->job_role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Assign Member</button>
                    </form>
                </div>
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

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome (optional, for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- script for display the comments related to the ticket -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ticketId = JSON.parse('@json($ticket->id)');

            // Fetch comments for the support ticket
            fetch(`/support-tickets/${ticketId}/comments`)
                .then(response => response.json())
                .then(comments => {
                    const container = document.getElementById('comments-container');
                    if (comments.length === 0) {
                        const noCommentsMessage = document.createElement('p');
                        noCommentsMessage.classList.add('text-center', 'text-muted');
                        noCommentsMessage.textContent = 'No comments yet.';
                        container.appendChild(noCommentsMessage);
                    } else {
                        comments.forEach(comment => {
                            const li = document.createElement('li');
                            li.classList.add('ks-item', 'd-flex', 'mb-3');

                            // Check if the current user is the comment owner
                            const isOwner = comment.user?.id === JSON.parse('@json(Auth::id())');

                            // Create the profile image and comment structure
                            const avatarSrc = comment.user?.profile_picture || 'https://bootdey.com/img/Content/avatar/avatar1.png';
                            li.innerHTML = `
                                <div class="ks-avatar me-2">
                                    <img src="${avatarSrc}" width="50" height="50" class="rounded-circle" alt="${comment.user?.name || 'User'}">
                                </div>
                                <div class="ks-comment-box flex-grow-1" id="comment-${comment.id}">
                                    <div class="ks-header d-flex justify-content-between align-items-center">          
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">Commented By:</span>
                                            <span class="ks-name fw-bold">${comment.user?.name || 'Unknown User'}</span>
                                        </div>
                                        <span class="ks-datetime">
                                            ${new Date(comment.created_at).toLocaleString()}
                                            ${comment.updated_at && comment.created_at !== comment.updated_at ? `<small class="text-muted"> (Updated)</small>` : ''}
                                        </span>
                                    </div>
                                    <div class="ks-body mt-1">
                                        <p>${comment.content}</p>
                                    </div>
                                    <div class="ks-footer mt-2">
                                        <div class="btn-group">
                                            ${isOwner ? `
                                                <button class="btn btn-outline-primary btn-sm" onclick="updateComment(${comment.id})">
                                                    <i class="bi bi-pencil"></i> Update
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm" onclick="deleteComment(${comment.id})">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            ` : ''}
                                            <button class="btn btn-outline-info btn-sm">
                                                <i class="bi bi-reply"></i> Reply
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `;
                            container.appendChild(li);
                        });
                    }
                })
                .catch(error => console.error('Error fetching comments:', error));
        });

        // Function to handle updating a comment
        function updateComment(commentId) {
            const commentElement = document.getElementById(`comment-${commentId}`);
            const commentContent = commentElement.querySelector('.ks-body p');

            const editableContent = document.createElement('textarea');
            editableContent.classList.add('form-control');
            editableContent.style.width = '100%';
            editableContent.style.height = '100px';
            editableContent.value = commentContent.textContent.trim();

            commentContent.replaceWith(editableContent);

            const footer = commentElement.querySelector('.ks-footer');
            footer.innerHTML = `
                <button class="btn btn-outline-success btn-sm" onclick="saveComment(${commentId}, this)">
                    <i class="bi bi-save"></i> Save changes
                </button>
            `;
        }

        // Function to save updated comment content
        function saveComment(commentId, buttonElement) {
            const commentElement = document.getElementById(`comment-${commentId}`);
            const editableContent = commentElement.querySelector('textarea');

            if (!editableContent) {
                console.error('Error: Editable content not found');
                return;
            }

            const newContent = editableContent.value.trim();

            if (newContent === '') {
                alert('Comment content cannot be empty.');
                return;
            }

            fetch(`/sup-Ticket-update-comments-admin/${commentId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ content: newContent })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Comment updated successfully.');

                    const updatedCommentContent = document.createElement('p');
                    updatedCommentContent.textContent = newContent;
                    editableContent.replaceWith(updatedCommentContent);

                    buttonElement.closest('.ks-footer').innerHTML = `
                        <div class="btn-group">
                            <button class="btn btn-outline-primary btn-sm" onclick="updateComment(${commentId})">
                                <i class="bi bi-pencil"></i> Update
                            </button>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteComment(${commentId})">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                            <button class="btn btn-outline-info btn-sm">
                                <i class="bi bi-reply"></i> Reply
                            </button>
                        </div>
                    `;
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => console.error('Error updating comment:', error));
        }

        // Function to delete a comment
        function deleteComment(commentId) {
            if (confirm('Are you sure you want to delete this comment?')) {
                fetch(`/sup-ticket-comments-delete-admin/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Comment deleted successfully.');
                        document.getElementById(`comment-${commentId}`).remove();
                    } else {
                        alert('Error: ' + data.error);
                    }
                })
                .catch(error => console.error('Error deleting comment:', error));
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle "Change Status" functionality
            const changeStatusButton = document.getElementById('changeStatusButton');
            const statusList = document.getElementById('statusList');
            const statusItems = statusList.querySelectorAll('.dropdown-item');

            // Show the status list when hovering over the "Change Status" button
            changeStatusButton.addEventListener('mouseenter', function () {
                statusList.classList.remove('d-none');
            });

            // Hide the status list after a short delay when the mouse leaves the button
            changeStatusButton.addEventListener('mouseleave', function () {
                setTimeout(() => {
                    if (!statusList.matches(':hover')) {
                        statusList.classList.add('d-none');
                    }
                }, 200);
            });

            // Ensure the status list stays visible when hovering over it
            statusList.addEventListener('mouseenter', function () {
                statusList.classList.remove('d-none');
            });

            // Hide the status list when the mouse leaves it
            statusList.addEventListener('mouseleave', function () {
                statusList.classList.add('d-none');
            });

            // Handle click events for each status item
            statusItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    const selectedStatus = item.textContent.trim();
                    const ticketId = document.getElementById('ticketId').value;

                    // Confirmation alert
                    if (confirm(`Are you sure you want to change the status to: ${selectedStatus}?`)) {
                        updateTicketStatus(ticketId, selectedStatus);
                    }
                });
            });
        });

        // Function to update the ticket status
        async function updateTicketStatus(ticketId, status) {
            try {
                const response = await fetch(`/support-ticket/${ticketId}/change-status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ status }),
                });

                const result = await response.json();

                if (result.success) {
                    alert(`Status updated to: ${status}`);
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert(`Failed to update status: ${result.message}`);
                }
            } catch (error) {
                console.error('Error updating status:', error);
                alert('An error occurred while updating the status.');
            }
        }

    </script>

</body>
</html>