<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Crea la tabella con i suoi relativi campi.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('stagioni', function (Blueprint $table) {
            $table->id('id_stagione');

            $table->unsignedBigInteger('id_serie');
            $table->foreign('id_serie')
                  ->references('id_serie')
                  ->on('serie')
                  ->cascadeOnDelete();// Collego la serie alla tabella serie e faccio eliminare automaticamente i record collegati quando la serie viene cancellata


            $table->text('descrizione')->nullable();

            $table->unsignedSmallInteger('numero_stagione');
            $table->unsignedSmallInteger('numero_episodi');

            // Evito doppioni della stessa stagione per la stessa serie
            $table->unique(['id_serie', 'numero_stagione'], 'uniq_serie_stagione');

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
        Schema::dropIfExists('stagioni');
    }
};
