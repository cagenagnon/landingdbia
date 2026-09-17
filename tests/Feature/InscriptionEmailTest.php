<?php

namespace Tests\Feature;

use App\Mail\BootcampConfirmation;
use App\Mail\WebinaireConfirmation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class InscriptionEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_invalid_email_is_rejected_for_both_forms(): void
    {
        $webinaireResponse = $this->postJson('/api/webinaire/inscriptions', [
            'nom' => 'Ada Lovelace',
            'email' => '666666',
            'telephone' => '+33123456789',
        ]);

        $bootcampResponse = $this->postJson('/api/bootcamp/candidatures', [
            'nom' => 'Grace Hopper',
            'email' => '666666',
            'telephone' => '+33123456789',
        ]);

        $webinaireResponse->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
        $bootcampResponse->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_invalid_name_and_phone_are_rejected_for_both_forms(): void
    {
        $webinaireResponse = $this->postJson('/api/webinaire/inscriptions', [
            'nom' => 'A1',
            'email' => 'ada@example.com',
            'telephone' => '22912ab',
        ]);

        $bootcampResponse = $this->postJson('/api/bootcamp/candidatures', [
            'nom' => 'A1',
            'email' => 'grace@example.com',
            'telephone' => '22912ab',
        ]);

        $webinaireResponse->assertUnprocessable()
            ->assertJsonValidationErrors(['nom', 'telephone']);
        $bootcampResponse->assertUnprocessable()
            ->assertJsonValidationErrors(['nom', 'telephone']);
    }

    public function test_webinaire_inscription_is_saved_and_confirmation_is_sent(): void
    {
        Mail::fake();

        $response = $this->postJson('/api/webinaire/inscriptions', [
            'nom' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'telephone' => '33123456789',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.email_envoye', true);

        $this->assertDatabaseHas('webinaire_inscriptions', [
            'email' => 'ada@example.com',
            'statut' => 'nouvelle',
        ]);

        Mail::assertSent(WebinaireConfirmation::class, function (WebinaireConfirmation $mail): bool {
            return $mail->nom === 'Ada Lovelace';
        });
    }

    public function test_bootcamp_candidature_is_saved_and_confirmation_is_sent(): void
    {
        Mail::fake();

        $response = $this->postJson('/api/bootcamp/candidatures', [
            'nom' => 'Grace Hopper',
            'email' => 'grace@example.com',
            'telephone' => '33123456789',
            'motivation' => 'Apprendre et construire.',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.email_envoye', true);

        $this->assertDatabaseHas('bootcamp_candidatures', [
            'email' => 'grace@example.com',
            'statut' => 'nouvelle',
        ]);

        Mail::assertSent(BootcampConfirmation::class, function (BootcampConfirmation $mail): bool {
            return $mail->nom === 'Grace Hopper';
        });
    }
}
