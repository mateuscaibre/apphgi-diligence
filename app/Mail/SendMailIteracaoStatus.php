<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailIteracaoStatus extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $status;
    private $link;

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

        return $this->from($this->user->email, "Notificação DD - Alteração de Status" )
        ->cc(config('app.notificacao'))
        ->subject("Nova Iteração na plataforma")
        ->view('emails.iteracao.status', compact('user','status','link'));
    }
}
