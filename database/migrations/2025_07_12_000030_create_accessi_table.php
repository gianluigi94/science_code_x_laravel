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
        Schema::create('accessi', function (Blueprint $table) {
            $table->id('id_accesso');
            $table->unsignedBigInteger('id_contatto')->nullable();
            $table->string('indirizzo_ip', 45)->nullable();
            $table->boolean('successo');

            $table->foreign('id_contatto')->references('id_contatto')->on('contatti')->cascadeOnDelete();// Collego il contatto e faccio eliminare automaticamente i record collegati quando il contatto viene cancellato

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
        Schema::dropIfExists('accessi');
    }
};
