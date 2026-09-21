<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BootcampConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $nom) {}

    public function build(): self
    {
        return $this->subject('Inscription enregistrée — Paiement à valider · Bootcamp Web DBIA')
            ->view('emails.bootcamp-confirmation')
            ->with(['nom' => $this->nom]);
    }
}
