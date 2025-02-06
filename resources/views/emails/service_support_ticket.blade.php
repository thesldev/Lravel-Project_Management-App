<!DOCTYPE html>
<html>
<head>
    <title>New Service Support Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .ticket-header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .table th {
            background: #007bff;
            color: white;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="ticket-header">
        <h2>New Service Support Ticket Created</h2>
    </div>

    <p>Hello,</p>
    <p>A new service support ticket has been raised by a client. Below are the details:</p>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Title</th>
                <td>{{ $ticket->title }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $ticket->description }}</td>
            </tr>
            <tr>
                <th>Priority</th>
                <td>
                    @if($ticket->priority == 'Critical')
                        <span class="badge bg-danger">{{ $ticket->priority }}</span>
                    @elseif($ticket->priority == 'High')
                        <span class="badge bg-warning">{{ $ticket->priority }}</span>
                    @elseif($ticket->priority == 'Medium')
                        <span class="badge bg-info">{{ $ticket->priority }}</span>
                    @else
                        <span class="badge bg-success">{{ $ticket->priority }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td><span class="badge bg-secondary">{{ $ticket->status }}</span></td>
            </tr>
            <tr>
                <th>Client ID</th>
                <td>{{ $ticket->client_id }}</td>
            </tr>
            <tr>
                <th>Service ID</th>
                <td>{{ $ticket->service_id }}</td>
            </tr>
        </tbody>
    </table>

    <p>Please log in to the system to review and take necessary action.</p>

    <div class="footer">
        <p>Best Regards,</p>
        <p><strong>Your Support Team</strong></p>
    </div>
</div>

</body>
</html>
