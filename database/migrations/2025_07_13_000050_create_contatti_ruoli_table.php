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
        Schema::create('contatti_ruoli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_contatto');
            $table->unsignedBigInteger('id_ruolo');
            $table->timestamps();

            $table->foreign('id_contatto')->references('id_contatto')->on('contatti')->cascadeOnDelete();// Collego il contatto e faccio eliminare automaticamente i record collegati quando il contatto viene cancellato

            $table->foreign('id_ruolo')->references('id_ruolo')->on('ruoli')->cascadeOnDelete();// Collego il ruolo alla tabella dei ruoli e faccio eliminare automaticamente i record collegati quando il ruolo viene cancellato

        });
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('contatti_ruoli');
    }
};
