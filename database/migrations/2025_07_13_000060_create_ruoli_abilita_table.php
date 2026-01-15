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
        Schema::create('ruoli_abilita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_abilita');
            $table->unsignedBigInteger('id_ruolo');

            $table->foreign('id_abilita')->references('id_abilita')->on('abilita')->cascadeOnDelete();// Collego l'abilità alla tabella delle abilità e faccio eliminare automaticamente i record collegati quando l'abilità viene cancellata

            $table->foreign('id_ruolo')->references('id_ruolo')->on('ruoli')->cascadeOnDelete(); // Collego il ruolo alla tabella dei ruoli e faccio eliminare automaticamente i record collegati quando il ruolo viene cancellato


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
        Schema::dropIfExists('ruoli_abilita');
    }
};
