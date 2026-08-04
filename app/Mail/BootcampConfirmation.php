<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BootcampConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $nom)
    {
    }

    public function build(): self
    {
        return $this->subject('Votre candidature au Bootcamp Web DBIA est reçue')
            ->view('emails.bootcamp-confirmation')
            ->with(['nom' => $this->nom]);
    }
}
