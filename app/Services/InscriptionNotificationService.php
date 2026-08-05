<?php

namespace App\Services;

use App\Mail\BootcampConfirmation;
use App\Mail\WebinaireConfirmation;
use App\Models\BootcampCandidature;
use App\Models\WebinaireInscription;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InscriptionNotificationService
{
    public function sendWebinaireConfirmation(WebinaireInscription $inscription): bool
    {
        if (!$this->isRealDeliveryMailer()) {
            Log::info('E-mail webinaire non envoye: mailer non-delivery actif', [
                'mailer' => (string) Config::get('mail.default'),
                'inscription_id' => $inscription->id,
                'email' => $inscription->email,
            ]);

            return false;
        }

        app()->terminating(function () use ($inscription): void {
            try {
                Mail::to($inscription->email)->send(new WebinaireConfirmation($inscription->nom));
            } catch (\Throwable $exception) {
                Log::error('Erreur envoi e-mail webinaire', [
                    'inscription_id' => $inscription->id,
                    'email' => $inscription->email,
                    'error' => $exception->getMessage(),
                ]);
            }
        });

        return true;
    }

    public function sendBootcampConfirmation(BootcampCandidature $candidature): bool
    {
        if (!$this->isRealDeliveryMailer()) {
            Log::info('E-mail bootcamp non envoye: mailer non-delivery actif', [
                'mailer' => (string) Config::get('mail.default'),
                'candidature_id' => $candidature->id,
                'email' => $candidature->email,
            ]);

            return false;
        }

        app()->terminating(function () use ($candidature): void {
            try {
                Mail::to($candidature->email)->send(new BootcampConfirmation($candidature->nom));
            } catch (\Throwable $exception) {
                Log::error('Erreur envoi e-mail bootcamp', [
                    'candidature_id' => $candidature->id,
                    'email' => $candidature->email,
                    'error' => $exception->getMessage(),
                ]);
            }
        });

        return true;
    }

    private function isRealDeliveryMailer(): bool
    {
        $mailer = (string) Config::get('mail.default');

        return !in_array($mailer, ['log', 'array'], true);
    }
}
