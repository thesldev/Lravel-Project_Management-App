<?php

namespace App\Mail;

use App\Models\GeneralTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GeneralTicketNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $ticket;

    public function __construct(GeneralTicket $ticket)
    {
        //
        $this->ticket = $ticket;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('New General Ticket Created')
                    ->view('emails.general_ticket_notification')
                    ->with([
                        'ticket' => $this->ticket,
                    ]);
    }
}
