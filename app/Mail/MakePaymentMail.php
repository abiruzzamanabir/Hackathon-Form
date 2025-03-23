<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MakePaymentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $name;
    public $ukey;
    public $email;
    public $phone;
    public $designation;
    public $organization;
    public $all_members;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_data)
    {
        $this->name = $user_data['name'];
        $this->email = $user_data['email'];
        $this->phone = $user_data['phone'];
        $this->ukey = $user_data['ukey'];
        $this->organization = $user_data['organization'];
        $this->designation = $user_data['designation'];
        $this->all_members = $user_data['all_members'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Congratulations on Forming Your Team!',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.makepayment',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
