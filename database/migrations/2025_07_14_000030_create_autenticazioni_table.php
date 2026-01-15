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
         Schema::create('autenticazioni', function (Blueprint $table) {
            $table->id('id_autenticazione');
            $table->unsignedBigInteger('id_contatto');
            $table->string('user', 255);
            $table->string('secret_jwt', 255)->nullable();
            $table->timestamp('inizio_sfida')->nullable();
            $table->datetime('inizio_token')->nullable();

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
        Schema::dropIfExists('autenticazioni');
    }
};
