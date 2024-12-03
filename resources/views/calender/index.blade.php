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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Calendar</h1>
                    </div>

                    <div class="container mt-4">
                        <!-- Ticket List -->
                        <div class="row">
                            <!-- Merged Code Part -->
                            <div class="container mt-5">
                                {{-- For Search --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="text" id="searchInput" class="form-control" placeholder="Search events">
                                            <div class="input-group-append">
                                                <button id="searchButton" class="btn btn-primary">
                                                    <i class="fas fa-search"></i> {{__('Search')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Container to align buttons to the right -->
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <div class="btn-group mb-3" role="group" aria-label="Calendar Actions">
                                            <button id="exportButton" class="btn btn-success">
                                                <i class="fas fa-file-export"></i> {{__('Export Calendar')}}
                                            </button>
                                        </div>
                                        <div class="btn-group mb-3 ms-2" role="group" aria-label="Calendar Actions">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                                                <i class="fas fa-calendar-plus"></i> {{__('Add Events')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                              <div class="card">
                                    <div class="card-body">
                                        <div id="calendar" style="width: 100%;height:100vh"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Merged Code Part -->

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

    <!-- Modal for create event -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addScheduleModalLabel">{{__('Add Schedule')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('calender.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">{{ __('User ID') }}</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ Auth::id() }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('Title') }}</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>

                        <div class="mb-3">
                            <label for="start" class="form-label">{{__('Start')}}</label>
                            <input type="date" class="form-control" id="start" name="start" required value="{{ now()->toDateString() }}">
                        </div>

                        <div class="mb-3">
                            <label for="end" class="form-label">{{__('End')}}</label>
                            <input type="date" class="form-control" id="end" name="end" required value="{{ now()->toDateString() }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">{{__('Description')}}</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">{{__('Color')}}</label>
                            <input type="color" class="form-control" id="color" name="color" />
                        </div>

                        <button type="submit" class="btn btn-success">{{__('Save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for display the selecyed event data -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Event details will be populated here -->
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    
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

    <!-- functions for handle claender -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            timeZone: 'UTC',
            events: '/events', // Endpoint to fetch events
            editable: true, // Allows event drag-and-drop and resizing
            eventDrop: function(info) {
                var eventId = info.event.id;
                var newStartDate = info.event.start;
                var newEndDate = info.event.end || newStartDate;
                var newStartDateUTC = newStartDate.toISOString().slice(0, 10);
                var newEndDateUTC = newEndDate.toISOString().slice(0, 10);

                // Make AJAX call to update the event on the server
                $.ajax({
                    method: 'post',
                    url: `/schedule/${eventId}`,
                    data: {
                        '_token': "{{ csrf_token() }}",
                        start_date: newStartDateUTC,
                        end_date: newEndDateUTC,
                    },
                    success: function() {
                        console.log('Event moved successfully.');
                        alert('Event moved successfully');
                    },
                    error: function(error) {
                        console.error('Error moving event:', error);
                        alert('Error moving event');
                    }
                });
            },
            eventResize: function(info) {
                var eventId = info.event.id;
                var newEndDate = info.event.end;
                var newEndDateUTC = newEndDate.toISOString().slice(0, 10);

                // Make AJAX call to update the event duration on the server
                $.ajax({
                    method: 'post',
                    url: `/schedule/${eventId}/resize`,
                    data: {
                        '_token': "{{ csrf_token() }}",
                        end_date: newEndDateUTC,
                    },
                    success: function() {
                        console.log('Event resized successfully.');
                        alert('Event resized successfully');
                    },
                    error: function(error) {
                        console.error('Error resizing event:', error);
                        alert('Error resizing event');
                    }
                });
            },
            eventClick: function(info) {
                var eventId = info.event.id;

                // Fetch event details from the server
                $.ajax({
                    method: 'get',
                    url: `/event/${eventId}`,
                    success: function(event) {
                        // Populate modal with event details
                        $('#eventModal .modal-title').text(event.title);
                        $('#eventModal .modal-body').html(`
                            <p><strong>Start Date:</strong> ${event.start}</p>
                            <p><strong>End Date:</strong> ${event.end}</p>
                            <p><strong>Description:</strong> ${event.description}</p>
                        `);
                        $('#eventModal').modal('show');
                    },
                    error: function() {
                        alert('Error fetching event details');
                    }
                });
            },
            eventContent: function(info) {
                var eventTitle = info.event.title;
                var eventElement = document.createElement('div');
                eventElement.innerHTML = '<span style="cursor: pointer;">❌</span> ' + eventTitle;

                eventElement.querySelector('span').addEventListener('click', function() {
                    if (confirm("Are you sure you want to delete this event?")) {
                        var eventId = info.event.id;
                        $.ajax({
                            method: 'DELETE',
                            url: '/events/' + eventId,
                            success: function(response) {
                                console.log(response.message);
                                calendar.refetchEvents();
                            },
                            error: function(error) {
                                console.error('Error deleting event:', error);
                            }
                        });
                    }
                });

                return {
                    domNodes: [eventElement]
                };
            }
        });

        calendar.render();

        // Add search functionality
        document.getElementById('searchButton').addEventListener('click', function() {
            var searchKeywords = document.getElementById('searchInput').value.toLowerCase();
            filterAndDisplayEvents(searchKeywords);
        });

        function filterAndDisplayEvents(searchKeywords) {
            $.ajax({
                method: 'GET',
                url: `/events/search?title=${searchKeywords}`,
                success: function(response) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(response);
                },
                error: function(error) {
                    console.error('Error searching events:', error);
                }
            });
        }
    </script>



</body>

</html>
