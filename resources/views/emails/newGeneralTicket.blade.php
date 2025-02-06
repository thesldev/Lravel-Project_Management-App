<!DOCTYPE html>
<html>
<head>
    <title>New General Ticket Notification</title>
</head>
<body>
    <h2>New Ticket Created</h2>

    <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
    <p><strong>Description:</strong> {{ $ticket->description }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
    <p><strong>Created By:</strong> {{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
    <p><strong>Created At:</strong> {{ $ticket->created_at->format('Y-m-d H:i') }}</p>

    <p>Please log in to the system to manage this ticket.</p>

    <a href="{{ route('ticket.viewGeneralTicket', ['id' => $ticket->id]) }}" 
       style="padding: 10px 20px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;">
       View Ticket
    </a>
</body>
</html>
