<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailClass extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $age;
    public $imageName;
    public $myMessage;

    public function __construct($name, $age, $imageName, $myMessage)
    {
        $this->name = $name;
        $this->age = $age;
        $this->imageName = $imageName;
        $this->myMessage = $myMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('SDM-Email')->view('emails.email')->attach(public_path('upload/images/') . $this->imageName);
    }
}
