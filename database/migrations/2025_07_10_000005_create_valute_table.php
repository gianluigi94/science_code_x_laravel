<?php
// database/migrations/2025_11_02_000000_create_valute_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('valute', function (Blueprint $table) {
            $table->id('id_valuta');
            $table->char('codice_iso', 3)->unique(); // es. EUR, USD
            $table->string('nome', 60);
            $table->string('simbolo', 8);
            $table->tinyInteger('decimali')->default(2); // es. JPY/ISK/HUF = 0
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('valute');
    }
};
