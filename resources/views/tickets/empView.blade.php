<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>View My Ticket - Employee Dashboard</title>

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
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body id="page-top">

    <div id="wrapper">

        <!-- Include Sidebar -->
        <x-employee-side-bar />

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
                            <h6 class="m-0 font-weight-bold text-primary">
                                Ticket {{ $ticket->id }} Information | Created At: {{ $ticket->created_at }}
                            </h6>
                            <button 
                                type="button" 
                                class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#changeStatusModal">
                                Change Status
                            </button>
                        </div>
                        <!-- display ticket data -->
                        <div class="card-body">
                            <div class="row">
                                <!-- Ticket Title -->
                                <p><strong>Ticket Title:</strong> {{ $ticket->title }}</p>

                                <!-- Ticket Priority -->
                                <div class="col-md-3 me-3">
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
                            <form method="POST" action="{{ route('comments.store', $ticket->id) }}">
                                @csrf
                                <div class="row">
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
                    <!-- Comment Section -->
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

    <!-- Change Status Modal -->
    <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true" data-current-status-id="{{ $ticket->status_id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStatusModalLabel">Change Ticket Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changeStatusForm" method="POST" action="{{ route('ticket.updateStatus', $ticket->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status_id">Select New Status</label>
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="">Select Status</option>
                                <!-- The dropdown options will be populated dynamically by the JavaScript code -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    <!-- fetch available status for ticket -->
    <script>
        $(document).ready(function() {
            // Get the current status ID from the modal's data attribute
            let currentStatusId = $('#changeStatusModal').data('current-status-id');

            $.ajax({
                url: '/api/ticketStatuses',
                method: 'GET',
                success: function(data) {
                    let statusDropdown = $('#status_id');
                    statusDropdown.empty();
                    statusDropdown.append('<option value="">Select Status</option>');

                    data.forEach(function(ticketStatus) {
                        // Append options to the dropdown, setting the selected attribute if it matches the current status
                        statusDropdown.append(
                            '<option value="' + ticketStatus.id + '" ' + 
                            (ticketStatus.id == currentStatusId ? 'selected' : '') +
                            '>' + ticketStatus.name + '</option>'
                        );
                    });
                },
                error: function(error) {
                    console.error('Error fetching ticket statuses:', error);
                }
            });
        });
        
    </script>

    <!-- script for display the comments related to the ticket -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const ticketId = JSON.parse('@json($ticket->id)');
        
        fetch(`/tickets/${ticketId}/comments`)
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


        // Placeholder functions for comment actions
        function updateComment(commentId) {
            console.log('Update comment with ID:', commentId);
            // Implement the update logic
        }

        // function for delete the comment
        function deleteComment(commentId) {
            if (confirm('Are you sure you want to delete this comment?')) {
                fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Comment deleted successfully.');
                        // Optionally remove the comment from the DOM
                        document.getElementById(`comment-${commentId}`).remove();
                    } else {
                        alert('Error: ' + data.error);
                    }
                })
                .catch(error => console.error('Error deleting comment:', error));
            }
        }

        // Function to handle the update button click
        function updateComment(commentId) {
            const commentElement = document.getElementById(`comment-${commentId}`);
            const commentContent = commentElement.querySelector('.ks-body p');

            // Convert the comment content into an editable text area
            const editableContent = document.createElement('textarea');
            editableContent.classList.add('form-control');
            editableContent.style.width = '100%';
            editableContent.style.height = '100px';
            editableContent.value = commentContent.textContent.trim();

            // Replace the paragraph with the editable text area
            commentContent.replaceWith(editableContent);

            // Hide existing buttons and show the 'Save changes' button
            const footer = commentElement.querySelector('.ks-footer');
            footer.innerHTML = `
                <button class="btn btn-outline-success btn-sm" onclick="saveComment(${commentId}, this)">
                    <i class="bi bi-save"></i> Save changes
                </button>
            `;
        }

        // Function to handle saving the comment changes
        function saveComment(commentId, buttonElement) {
            const commentElement = document.getElementById(`comment-${commentId}`);
            const editableContent = commentElement.querySelector('textarea');

            if (!editableContent) {
                console.error('Error: Editable content not found');
                return;
            }

            // Get the new content from the textarea
            const newContent = editableContent.value.trim();

            if (newContent === '') {
                alert('Comment content cannot be empty.');
                return;
            }

            fetch(`/comments/${commentId}`, {
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

                    // Replace the textarea with the updated content
                    const updatedCommentContent = document.createElement('p');
                    updatedCommentContent.textContent = newContent;
                    editableContent.replaceWith(updatedCommentContent);

                    // Replace the 'Save changes' button with the original buttons
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

    </script>

    <script>
        $(document).ready(function(){
            $('.jspContainer').jScrollPane();
        });
    </script>

</body>
</html>
