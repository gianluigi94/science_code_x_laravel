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
        Schema::create('film_traduzioni', function (Blueprint $table) {
            $table->id('id_film_traduzione');

            $table->unsignedBigInteger('id_film');
            $table->unsignedBigInteger('id_lingua');

            $table->string('img_titolo', 255)->nullable();
            $table->string('titolo', 255);

            $table->string('sottotitolo', 255)->nullable();
            $table->string('trailer', 512)->nullable();
            $table->text('descrizione')->nullable();
            $table->string('img_locandina', 512)->nullable();

            $table->foreign('id_film')
                  ->references('id_film')->on('film')
                  ->cascadeOnDelete();// Collego il film alla tabella film e faccio eliminare automaticamente i record collegati quando il film viene cancellato


            $table->foreign('id_lingua')
                  ->references('id_lingua')->on('lingue')
                  ->cascadeOnDelete();// Collego la lingua alla tabella lingue e faccio eliminare automaticamente i record collegati quando la lingua viene cancellata


            $table->unique(['id_film', 'id_lingua'], 'uniq_film_lingua');

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
        Schema::dropIfExists('film_traduzioni');
    }
};
