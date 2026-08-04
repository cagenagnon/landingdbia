<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinaire_inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email');
            $table->string('telephone');
            $table->string('type_activite', 40)->default('webinaire');
            $table->string('statut', 30)->default('nouvelle');
            $table->timestamps();

            $table->index('email');
            $table->index('telephone');
            $table->index('created_at');
            $table->index('statut');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinaire_inscriptions');
    }
};
