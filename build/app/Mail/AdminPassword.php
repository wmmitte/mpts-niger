<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\Boolean;

class AdminPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $user;
    public $reset;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password, int $reset)
    {
        //
        $this->user = $user;
        $this->reset = $reset ?? 0;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.admin-access');
    }
}
