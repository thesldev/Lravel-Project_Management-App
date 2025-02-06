<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SupportTicket;

class ServiceSupportTicketNotification extends Mailable {
    use Queueable, SerializesModels;

    public $supportTicket;

    public function __construct(SupportTicket $supportTicket) {
        $this->supportTicket = $supportTicket;
    }

    public function build() {
        return $this->subject('New Service Support Ticket Created')
                    ->view('emails.service_support_ticket')
                    ->with([
                        'ticket' => $this->supportTicket,
                    ]);
    }
}
