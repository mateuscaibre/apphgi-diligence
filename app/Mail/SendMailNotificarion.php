<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailNotificarion extends Mailable
{


    use Queueable, SerializesModels;

    private $assunto;
    private $mensagem;
    private $titulo;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($assunto='', $mensagem = '', $titulo='')
    {
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
        $this->titulo = $titulo;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mensagem = $this->mensagem;
        $titulo = $this->titulo;
        return $this->from('notificacao@hgi.kroqui.com.br', config("app.name"))
        ->subject($this->assunto)
        ->view('emails.notificacao.mail', compact('mensagem','titulo'));


    }
}
