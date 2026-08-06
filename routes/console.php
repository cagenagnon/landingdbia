<?php

use App\Mail\BootcampConfirmation;
use App\Mail\WebinaireConfirmation;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mail:test-inscription {to : Email de destination}', function (): int {
    $to = (string) $this->argument('to');

    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        $this->error('Adresse e-mail invalide.');

        return self::FAILURE;
    }

    try {
        Mail::mailer('smtp')->to($to)->send(new WebinaireConfirmation('Test Webinaire'));
        Mail::mailer('smtp')->to($to)->send(new BootcampConfirmation('Test Bootcamp'));

        $this->info('E-mails de test envoyes avec succes.');

        return self::SUCCESS;
    } catch (\Throwable $exception) {
        Log::error('Echec commande mail:test-inscription', [
            'to' => $to,
            'error' => $exception->getMessage(),
        ]);

        $this->error('Echec envoi SMTP: '.$exception->getMessage());

        return self::FAILURE;
    }
})->purpose('Envoie les e-mails de confirmation Webinaire et Bootcamp a une adresse de test');
