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

    <link href="{{ asset('css/comments-styles.css') }}" rel="stylesheet" />
    <!-- jQuery (necessary for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <h1 class="h3 mb-4 text-gray-800">Ticket  #{{ $ticket->id }} Details</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Ticket {{ $ticket->id }} Information | Created At: {{ $ticket->created_at }}</h6>
                            <!-- Ellipsis Button -->
                            <button class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#actionModal">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>

                        </div>
                        <!-- display ticket data -->
                        <div class="card-body">
                            <div class="row">
                                <!-- Ticket Title -->
                                <p><strong>Ticket Title:</strong> {{ $ticket->title }}</p>

                                <!-- Ticket Priority -->
                                <div class="col-md-3 me-3 ">
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
                                        <span class="mx-3">|</span> <!-- Add margin around the separator -->
                                        Job Role: <strong>{{ $ticket->assignee->job_role }}</strong>
                                        <span class="mx-3">|</span> <!-- Add margin around the separator -->
                                        Position: <strong>{{ $ticket->assignee->position }}</strong>
                                    </p>
                                </div>
                                <div class="col-md-3 me-3">
                                    <p>Due Date: <strong>{{ $ticket->due_date }}</strong></p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('comments.storeAdmin', $ticket->id) }}">
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

    <!-- Modal Structure -->
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionModalLabel">Actions for Ticket  #{{ $ticket->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Select an action below:</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="updateButton">Update</button>
                    <form method="POST" action="{{ route('ticket.destroy', $ticket->id) }}" style="display: inline;" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" id="deleteButton" onclick="return confirm('Are you sure you want to delete this ticket?');">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Update Ticket Modal -->
    <div class="modal fade" id="updateTicketModal" tabindex="-1" aria-labelledby="updateTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTicketModalLabel">Update Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateTicketForm" method="POST" action="/tickets/{ticket}/update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="ticket_id" id="ticket_id">
                    <div class="modal-body">
                        <!-- Form fields as provided -->
                        <div class="mb-3">
                            <label for="update_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="update_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="update_description" class="form-label">Description</label>
                            <textarea class="form-control" id="update_description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="update_priority" class="form-label">Priority</label>
                            <select class="form-select" id="update_priority" name="priority" required>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Critical">Critical</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="update_status_id" class="form-label">Ticket Status</label>
                            <select class="form-select" id="update_status_id" name="status_id" required>
                                <!-- Options populated dynamically -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="update_type_id" class="form-label">Ticket Type</label>
                            <select class="form-select" id="update_type_id" name="type_id" required>
                                <!-- Options populated dynamically -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="update_project_id" class="form-label">Project</label>
                            <select class="form-select" id="update_project_id" name="project_id">
                                <!-- Options populated dynamically -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="update_due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="update_due_date" name="due_date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- scripts for update form -->

    <!-- fetch dynamic data for disply update form -->
    <script>
        $(document).ready(function () {
            // Fetch and populate the Project dropdown
            $.ajax({
                url: '/api/projects',
                method: 'GET',
                success: function (data) {
                    let projectDropdown = $('#update_project_id');
                    projectDropdown.empty();
                    projectDropdown.append('<option value="">Select Project</option>');
                    data.forEach(function (project) {
                        projectDropdown.append('<option value="' + project.id + '">' + project.name + '</option>');
                    });
                },
                error: function (error) {
                    console.error('Error fetching projects:', error);
                }
            });

            // Fetch and populate the Ticket Type dropdown
            $.ajax({
                url: '/api/ticketType',
                method: 'GET',
                success: function (data) {
                    let typeDropdown = $('#update_type_id');
                    typeDropdown.empty();
                    typeDropdown.append('<option value="">Select Type</option>');
                    data.forEach(function (ticketType) {
                        typeDropdown.append('<option value="' + ticketType.id + '">' + ticketType.name + '</option>');
                    });
                },
                error: function (error) {
                    console.error('Error fetching ticket types:', error);
                }
            });

            // Fetch and populate the Ticket Status dropdown
            $.ajax({
                url: '/api/ticketStatuses',
                method: 'GET',
                success: function (data) {
                    let statusDropdown = $('#update_status_id');
                    statusDropdown.empty();
                    statusDropdown.append('<option value="">Select Status</option>');
                    data.forEach(function (ticketStatus) {
                        statusDropdown.append('<option value="' + ticketStatus.id + '">' + ticketStatus.name + '</option>');
                    });
                },
                error: function (error) {
                    console.error('Error fetching ticket statuses:', error);
                }
            });
        });
    </script>

    <!-- update poppu box -->
    <script>
        $(document).ready(function () {
            function populateUpdateModal(data) {
                $('#ticket_id').val(data.id || '{{ $ticket->id }}');
                $('#update_title').val(data.title || '{{ $ticket->title }}');
                $('#update_description').val(data.description || '{{ $ticket->description }}');
                $('#update_priority').val(data.priority || '{{ $ticket->priority }}');
                $('#update_status_id').val(data.status_id || '{{ $ticket->status_id }}');
                $('#update_type_id').val(data.type_id || '{{ $ticket->type_id }}');
                $('#update_project_id').val(data.project_id || '{{ $ticket->project_id }}');
                $('#update_due_date').val(data.due_date || '{{ $ticket->due_date }}');
            }

            // Event listener for Update button
            $('#updateButton').on('click', function () {
                const ticketData = {
                    id: '{{ $ticket->id }}',
                    title: '{{ $ticket->title }}',
                    description: '{{ $ticket->description }}',
                    priority: '{{ $ticket->priority }}',
                    status_id: '{{ $ticket->status_id }}',
                    type_id: '{{ $ticket->type_id }}',
                    project_id: '{{ $ticket->project_id }}',
                    due_date: '{{ $ticket->due_date }}',
                };

                // Populate the modal fields
                populateUpdateModal(ticketData);

                // Fetch and populate dropdown data dynamically
                populateDropdowns();

                // Show the modal
                $('#updateTicketModal').modal('show');
            });

            // Function to dynamically populate dropdown fields
            function populateDropdowns() {

                // Populate Status dropdown
                $.ajax({
                    url: '/statuses/all',
                    method: 'GET',
                    success: function (data) {
                        let statusDropdown = $('#update_status_id');
                        statusDropdown.empty();
                        statusDropdown.append('<option value="">Select Status</option>');
                        data.forEach(function (status) {
                            statusDropdown.append(
                                `<option value="${status.id}" ${status.id == '{{ $ticket->status_id }}' ? 'selected' : ''}>
                                    ${status.name}
                                </option>`
                            );
                        });
                    },
                    error: function (error) {
                        console.error('Error fetching statuses:', error);
                    },
                });

                // Populate Type dropdown
                $.ajax({
                    url: '/types/all',
                    method: 'GET',
                    success: function (data) {
                        let typeDropdown = $('#update_type_id');
                        typeDropdown.empty();
                        typeDropdown.append('<option value="">Select Type</option>');
                        data.forEach(function (type) {
                            typeDropdown.append(
                                `<option value="${type.id}" ${type.id == '{{ $ticket->type_id }}' ? 'selected' : ''}>
                                    ${type.name}
                                </option>`
                            );
                        });
                    },
                    error: function (error) {
                        console.error('Error fetching types:', error);
                    },
                });

                // Populate Project dropdown
                $.ajax({
                    url: '/projects/all',
                    method: 'GET',
                    success: function (data) {
                        let projectDropdown = $('#update_project_id');
                        projectDropdown.empty();
                        projectDropdown.append('<option value="">Select Project</option>');
                        data.forEach(function (project) {
                            projectDropdown.append(
                                `<option value="${project.id}" ${project.id == '{{ $ticket->project_id }}' ? 'selected' : ''}>
                                    ${project.name}
                                </option>`
                            );
                        });
                    },
                    error: function (error) {
                        console.error('Error fetching projects:', error);
                    },
                });
            }

            // Reset modal fields on close
            $('#updateTicketModal').on('hidden.bs.modal', function () {
                $('#updateTicketForm')[0].reset();
                // Clear dropdowns
                $(' #update_status_id, #update_type_id, #update_project_id').empty();
            });


            // Event listener for the Update button
            $(document).ready(function () {
                $('#updateTicketForm').submit(function(event) {
                    event.preventDefault();

                    console.log('Form data:', {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        title: $('#update_title').val(),
                        description: $('#update_description').val(),
                        priority: $('#update_priority').val(),
                        status_id: $('#update_status_id').val(),
                        type_id: $('#update_type_id').val(),
                        project_id: $('#update_project_id').val(),
                        due_date: $('#update_due_date').val(),
                        reporter_id: $('#update_reporter_id').val()
                    });

                    $.ajax({
                        url: '/tickets/' + $('#ticket_id').val() + '/update',
                        method: 'PUT',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            title: $('#update_title').val(),
                            description: $('#update_description').val(),
                            priority: $('#update_priority').val(),
                            status_id: $('#update_status_id').val(),
                            type_id: $('#update_type_id').val(),
                            project_id: $('#update_project_id').val(),
                            due_date: $('#update_due_date').val(),
                            reporter_id: $('#update_reporter_id').val()
                        },
                        success: function(response) {
                            alert('Ticket updated successfully!');
                            location.reload();  // Optional: reload the page to reflect changes
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr);
                            alert('Failed to update the ticket. Please try again.');
                        }
                    });
                });
            });


        });

    </script>

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
        
        fetch(`/tickets/${ticketId}/adminComments`)
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