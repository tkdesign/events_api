<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventUnsubscribe extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $email;
    public $event;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $email, $event)
    {
        //
        $this->user = $user;
        $this->email = $email;
        $this->event = $event;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Event Unsubscribe',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'unsubscribe',
            with: [
                'user' => $this->user,
                'full_name' => join(' ', [$this->user->first_name, $this->user->last_name]),
                'email' => $this->email,
                'event' => $this->event,
            ],

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
