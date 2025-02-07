<!DOCTYPE html>
<html>
<head>
    <title>New Project Support Ticket Created</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #181818;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .content {
            background-color: #181818;
            padding: 20px;
            font-size: small;
            color: #cccccc;
        }

        .content h2{
            font-size: medium;
            color: #cccccc;
            text-align: center;
        }

        .content p{
            font-size: small;
            color: #ffffff;
        }

        .content a{
            color: #ffffff;
        }

        .ticket-header {
            background: #007bff;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .footer {
            background-color: #181818;
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #cccccc;
        }
        .footer a {
            color: #7e3aff;
            text-decoration: none;
        }
        .footer-icons img {
            width: 16px;
            margin: 0 5px;
            opacity: 0.8;
        }
        .content h2 {
            font-weight: bold;
            color: #ffffff;
        }
        .content p {
            margin: 10px 0;
            color: #ffffff;
        }
        .ticket-info p {
            font-weight: 500;
            color: #ffffff;
        }
        .ticket-details {
            display: flex;
            gap: 20px;
            font-size: smaller;
            font-weight: 500;
            color: #ffffff;
            margin: 15px 0;
        }
        .priority {
            color: #ff4d4d;
            font-weight: bold;
        }
        .status {
            color: #6c757d;
            font-weight: bold;
        }
        .cta-button {
            background-color: #7e3aff;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 24px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="content">
            <h2>New Support-Ticket (Project) Created</h2>
            <p>Hello Team,</p>
            <p>A new project support ticket has been raised. Below are the details:</p>
            <br>
            <div class="ticket-info">
                <p class="title"><strong>Title:</strong> {{ $ticket->title }}</p>
                <p><strong>Description:</strong> {{ $ticket->description }}</p>

                <div class="ticket-details">
                    <span><strong>Priority:</strong> 
                        @if($ticket->priority == 'Critical')
                            <span class="priority">{{ $ticket->priority }}</span>
                        @elseif($ticket->priority == 'High')
                            <span style="color: #ffcc00;">{{ $ticket->priority }}</span>
                        @elseif($ticket->priority == 'Medium')
                            <span style="color: #17a2b8;">{{ $ticket->priority }}</span>
                        @else
                            <span style="color: #28a745;">{{ $ticket->priority }}</span>
                        @endif
                    </span>

                    <span><strong>Status:</strong> 
                        <span class="status">{{ $ticket->status }}</span>
                    </span>
                </div>
                <br>
                <p><strong>Project ID:</strong> {{ $ticket->project_id ?? 'N/A' }}</p>
            </div>

            <a href="" class="cta-button">View Ticket Details</a>

            <br>
            <br>

            <p>Best Regards,</p>
            <p><strong>Claps - Project Management Tool</strong></p>
        </div>

        <div class="footer">
            <p>
                You are receiving this email because of your activity on the Project Management Tool. If you wish to stop receiving notifications, you can 
                <a href="#">manage your notification preferences</a>.
            </p>
            <p>© 2025 Claps-Dev, No.40, Kirimetiyana west, Lunuwila, (NWP) Sri Lanka</p>
        </div>
    </div>
</body>
</html>
