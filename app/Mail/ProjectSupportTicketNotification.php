<?php

namespace App\Mail;

use App\Models\SupportTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectSupportTicketNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $ticket;

    public function __construct(SupportTicket $ticket)
    {
        //
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->subject('New Project Support Ticket Created')
                    ->view('emails.project_support_ticket_notification')
                    ->with([
                        'ticket' => $this->ticket,
                    ]);
    }

    
}
