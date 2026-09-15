<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WebinaireConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $nom) {}

    public function build(): self
    {
        return $this->subject('Votre inscription au Webinaire DBIA est confirmée')
            ->view('emails.webinaire-confirmation')
            ->with(['nom' => $this->nom]);
    }
}
