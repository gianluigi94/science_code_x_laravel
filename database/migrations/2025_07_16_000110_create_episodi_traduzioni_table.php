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
        Schema::create('episodi_traduzioni', function (Blueprint $table) {
            $table->id('id_episodio_traduzione');

            $table->unsignedBigInteger('id_episodio');
            $table->unsignedBigInteger('id_lingua');

            $table->string('titolo', 255);
            $table->text('descrizione')->nullable();

            $table->foreign('id_episodio')
                  ->references('id_episodio')->on('episodi')
                  ->cascadeOnDelete();// Collego l'episodio alla tabella episodi e faccio eliminare automaticamente i record collegati quando l'episodio viene cancellato


            $table->foreign('id_lingua')
                  ->references('id_lingua')->on('lingue')
                  ->cascadeOnDelete();// Collego la lingua alla tabella lingue e faccio eliminare automaticamente i record collegati quando la lingua viene cancellata

//evito duplicati
            $table->unique(['id_episodio', 'id_lingua'], 'uniq_episodio_lingua');

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
        Schema::dropIfExists('episodi_traduzioni');
    }
};
