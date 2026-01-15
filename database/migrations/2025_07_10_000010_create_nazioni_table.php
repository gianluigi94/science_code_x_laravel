<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabella con i suoi relativi campi.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('nazioni', function (Blueprint $table) {
            $table->id('id_nazione');
            $table->string('nazione_it', 45);
            $table->string('nazione_en', 45);
            $table->string('continente', 45);
            $table->char('iso', 2);
            $table->char('iso3', 3);
            $table->string('prefisso_tel', 45);
            $table->unsignedBigInteger('id_valuta')->nullable();
            $table->foreign('id_valuta')->references('id_valuta')->on('valute');// Collego la valuta alla tabella delle valute disponibili


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('nazioni');
    }
};
