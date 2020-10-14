<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompletasteTuComunidad extends Mailable
{
    use Queueable, SerializesModels;
    protected $titulo;
    protected $mensaje;
    protected $pago;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $titulo, $mensaje, $pago, $user )
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
        return $this->view( 'emails.emailcompletacomunidad' )->with([
            'titulo'  =>  $this->titulo,
            'mensaje'  =>  $this->mensaje,
            'pago'  =>  $this->pago,
            'user'  =>  $this->user
        ]);
    }
}
