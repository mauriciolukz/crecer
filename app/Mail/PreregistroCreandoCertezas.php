<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PreregistroCreandoCertezas extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $nombre;
    public $codigo;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$codigo,$email,$nombre)
    {
        $this->user = $user;
        $this->codigo = $codigo;
        $this->email = $email;
        $this->nombre = $nombre;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.emailpreregistro');
    }
}
