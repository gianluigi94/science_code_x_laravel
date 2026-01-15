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
        Schema::create('categorie_traduzioni', function (Blueprint $table) {
            $table->id('id_categoria_traduzione');

            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_lingua');

            $table->string('nome', 100);

            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categorie')
                  ->cascadeOnDelete();// Collego la categoria alla tabella categorie e faccio eliminare automaticamente i record collegati quando la categoria viene cancellata


            $table->foreign('id_lingua')
                  ->references('id_lingua')
                  ->on('lingue')
                  ->cascadeOnDelete();// Collego la lingua alla tabella lingue e faccio eliminare automaticamente i record collegati quando la lingua viene cancellata


                  //evito duplicati
            $table->unique(['id_categoria', 'id_lingua'], 'uniq_categoria_lingua');

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
        Schema::dropIfExists('categorie_traduzioni');
    }
};
