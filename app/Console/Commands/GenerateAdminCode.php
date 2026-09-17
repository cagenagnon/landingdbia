<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenerateAdminCode extends Command
{
    protected $signature = 'admin:code';

    protected $description = 'Genere le hash du code d acces administrateur';

    public function handle(): int
    {
        $code = $this->secret('Saisissez le code administrateur');
        if ($code === '') {
            $this->error('Le code ne peut pas etre vide.');

            return self::FAILURE;
        }

        $confirmation = $this->secret('Confirmez le code administrateur');
        if (! hash_equals($code, $confirmation)) {
            $this->error('Les codes ne correspondent pas.');

            return self::FAILURE;
        }

        $this->newLine();
        $this->info('Ajoutez cette variable dans .env et Railway :');
        $this->line('ADMIN_ACCESS_CODE_HASH='.Hash::make($code));

        return self::SUCCESS;
    }
}
