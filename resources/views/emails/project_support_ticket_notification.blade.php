<!DOCTYPE html>
<html>
<head>
    <title>New Project Support Ticket Created</title>
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
        <h2>New Project Support Ticket Created</h2>
    </div>

    <p>Hello,</p>
    <p>A new project support ticket has been raised. Below are the details:</p>

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
                        <span class="badge bg-danger">Critical</span>
                    @elseif($ticket->priority == 'High')
                        <span class="badge bg-warning">High</span>
                    @elseif($ticket->priority == 'Medium')
                        <span class="badge bg-info">Medium</span>
                    @else
                        <span class="badge bg-success">Low</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td><span class="badge bg-secondary">{{ $ticket->status }}</span></td>
            </tr>
            <tr>
                <th>Project ID</th>
                <td>{{ $ticket->project_id ?? 'N/A' }}</td>
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
