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
        Schema::create('episodi', function (Blueprint $table) {
            $table->id('id_episodio');

            $table->unsignedBigInteger('id_stagione');
            $table->foreign('id_stagione')
                  ->references('id_stagione')
                  ->on('stagioni')
                  ->cascadeOnDelete();


             $table->unsignedBigInteger('id_serie');
            $table->foreign('id_serie')
                  ->references('id_serie')
                  ->on('serie')
                  ->cascadeOnDelete();





            $table->string('descrizione', 255)->unique();

            $table->unsignedSmallInteger('numero_episodio');
            $table->unsignedInteger('durata');// minuti
            $table->string('img_anteprima', 512);

            $table->unsignedBigInteger('id_streaming_file');
            $table->foreign('id_streaming_file')
                  ->references('id_streaming_file')
                  ->on('streaming_file')
                  ->cascadeOnDelete();// Collego il file di streaming alla tabella streaming_file e faccio eliminare automaticamente i record collegati quando il file viene cancellato


            // Evito doppioni (stessa stagione, stesso numero)
            $table->unique(['id_stagione', 'numero_episodio'], 'uniq_stagione_ep');

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
        Schema::dropIfExists('episodi');
    }
};
