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
        Schema::create('serie_traduzioni', function (Blueprint $table) {
            $table->id('id_serie_traduzione');

            $table->unsignedBigInteger('id_serie');
            $table->unsignedBigInteger('id_lingua');


            $table->string('titolo', 255);

            $table->string('sottotitolo', 255)->nullable();
            $table->text('descrizione')->nullable();

            $table->foreign('id_serie')
                  ->references('id_serie')
                  ->on('serie')
                  ->cascadeOnDelete();// Collego la serie alla tabella serie e faccio eliminare automaticamente i record collegati quando la serie viene cancellata


            $table->foreign('id_lingua')
                  ->references('id_lingua')
                  ->on('lingue')
                  ->cascadeOnDelete();// Collego la lingua alla tabella lingue e faccio eliminare automaticamente i record collegati quando la lingua viene cancellata


            // Evito doppioni stessa lingua per stessa serie
            $table->unique(['id_serie', 'id_lingua'], 'uniq_serie_lingua');

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
        Schema::dropIfExists('serie_traduzioni');
    }
};
