<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailJurado extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject;

    public $contraseña;
    public $email;
    public $nombre;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre,$email,$contraseña,$anio)
    {
        $this->subject = 'Periodo de Admision '.$anio;
        $this->contraseña=$contraseña;
        $this->email=$email;
        $this->nombre=$nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mails.MensajeJurado');
    }
}
