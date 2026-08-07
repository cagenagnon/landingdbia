<?php

namespace App\Services;

use App\Mail\BootcampConfirmation;
use App\Mail\WebinaireConfirmation;
use App\Models\BootcampCandidature;
use App\Models\WebinaireInscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InscriptionNotificationService
{
    public function sendWebinaireConfirmation(WebinaireInscription $inscription): bool
    {
        try {
            Mail::mailer('smtp')->to($inscription->email)->send(new WebinaireConfirmation($inscription->nom));

            return true;
        } catch (\Throwable $exception) {
            Log::error('Erreur envoi e-mail webinaire', [
                'inscription_id' => $inscription->id,
                'email' => $inscription->email,
                'error' => $exception->getMessage(),
            ]);

            return false;
        }
    }

    public function sendBootcampConfirmation(BootcampCandidature $candidature): bool
    {
        try {
            Mail::mailer('smtp')->to($candidature->email)->send(new BootcampConfirmation($candidature->nom));

            return true;
        } catch (\Throwable $exception) {
            Log::error('Erreur envoi e-mail bootcamp', [
                'candidature_id' => $candidature->id,
                'email' => $candidature->email,
                'error' => $exception->getMessage(),
            ]);

            return false;
        }
    }
}
