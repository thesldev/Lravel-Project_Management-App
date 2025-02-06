<?php

namespace App\Mail;

use App\Models\GeneralTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewGeneralTicketNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket;
    /**
     * Create a new message instance.
     */
    public function __construct(GeneralTicket $ticket)
    {
        //
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New General Ticket Created - #' . $this->ticket->id)
                    ->view('emails.newGeneralTicket')
                    ->with([
                        'ticket' => $this->ticket
                    ]);
    }
}
