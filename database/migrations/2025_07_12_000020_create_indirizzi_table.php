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
        Schema::create('indirizzi', function (Blueprint $table) {
    $table->id('id_indirizzo');

    $table->unsignedBigInteger('id_contatto');
    $table->foreign('id_contatto')->references('id_contatto')->on('contatti')->cascadeOnDelete();// Collego il contatto e faccio eliminare automaticamente i record collegati quando il contatto viene cancellato

    $table->unsignedBigInteger('id_tipo_indirizzo');
    $table->foreign('id_tipo_indirizzo')->references('id_tipo_indirizzo')->on('tipi_indirizzi');// Collego il tipo di indirizzo alla tabella dei tipi disponibili

    $table->unsignedBigInteger('id_nazione');
    $table->foreign('id_nazione')->references('id_nazione')->on('nazioni');// Collego la nazione alla tabella delle nazioni disponibili

    $table->unsignedBigInteger('id_comune')->nullable();
    $table->foreign('id_comune')->references('id_comune')->on('comuni');// Collego il comune alla tabella dei comuni disponibili

    $table->string('cap', 10)->nullable();
    $table->string('indirizzo', 255);
    $table->string('civico', 10);

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
        Schema::dropIfExists('indirizzi');
    }
};
