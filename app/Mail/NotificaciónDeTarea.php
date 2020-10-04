<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificaciónDeTarea extends Mailable
{
    use Queueable, SerializesModels;
  
public $titulo;
public $mensaje;
public $pago;
public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($titulo,$mensaje,$pago,$user)
    {
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->pago = $pago;
        $this->user = $user;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.emailBienvenida');
    }
}