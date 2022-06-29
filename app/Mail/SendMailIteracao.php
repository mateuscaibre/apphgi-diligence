<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailIteracao extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $status;
    private $link;
    //private $from;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $status = null, $link=null)
    {
        $this->user = $user;
        $this->status = $status;
        $this->link = $link;
      // $this->from = $from;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $status = $this->status;
        $link = $this->link;
        $user = $this->user;
        return $this->from(config('app.notificacao'), "Notificação DD" )
        ->cc('andrecabrall@gmail.com')
        ->subject("Nova Iteração na plataforma")
        ->view('emails.iteracao.iteracao', compact('user','status','link'));
    }
}
