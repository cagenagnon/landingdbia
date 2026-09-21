<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bootcamp_candidatures', function (Blueprint $table) {
            $table->dropIndex(['email']);
            $table->unique('email');
        });
    }

    public function down(): void
    {
        Schema::table('bootcamp_candidatures', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->index('email');
        });
    }
};
