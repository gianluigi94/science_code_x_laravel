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
        Schema::create('film', function (Blueprint $table) {
            $table->id('id_film');
            $table->string('descrizione', 255)->unique();
            $table->unsignedBigInteger('id_regista');
            $table->foreign('id_regista')
                  ->references('id_regista')
                  ->on('registi')
                  ->cascadeOnDelete();// Collego il regista alla tabella registi e faccio eliminare automaticamente i record collegati quando il regista viene cancellato


            $table->unsignedSmallInteger('anno');
             $table->unsignedInteger('durata');
            $table->string('img_sfondo', 512);

            $table->unsignedBigInteger('id_streaming_file');
            $table->foreign('id_streaming_file')
                  ->references('id_streaming_file')
                  ->on('streaming_file')
                  ->cascadeOnDelete();// Collego il file di streaming alla tabella streaming_file e faccio eliminare automaticamente i record collegati quando il file viene cancellato


            $table->boolean('novita')->default(false)->index();

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
        Schema::dropIfExists('film');
    }
};
