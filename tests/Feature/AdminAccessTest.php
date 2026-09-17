<?php

namespace Tests\Feature;

use App\Models\WebinaireInscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['admin.access_code_hash' => Hash::make('code-de-test')]);
    }

    public function test_admin_page_requires_the_access_code(): void
    {
        $this->get('/admin/inscriptions')
            ->assertRedirect('/admin/login');
    }

    public function test_correct_code_grants_access_to_admin_api(): void
    {
        WebinaireInscription::create([
            'nom' => 'Admin Test',
            'email' => 'admin@example.com',
            'telephone' => '0102030405',
            'type_activite' => 'webinaire',
            'statut' => 'nouvelle',
        ]);

        $this->post('/admin/login', ['code' => 'code-de-test'])
            ->assertRedirect('/admin/inscriptions');

        $this->getJson('/api/admin/inscriptions/webinaire')
            ->assertOk()
            ->assertJsonPath('meta.total', 1);
    }

    public function test_wrong_code_does_not_grant_access(): void
    {
        $this->from('/admin/login')
            ->post('/admin/login', ['code' => 'incorrect'])
            ->assertRedirect('/admin/login')
            ->assertSessionHasErrors('code');

        $this->get('/admin/inscriptions')
            ->assertRedirect('/admin/login');
    }
}
