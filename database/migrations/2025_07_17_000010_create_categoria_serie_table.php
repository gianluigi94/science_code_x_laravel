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
        Schema::create('categoria_serie', function (Blueprint $table) {
            $table->id('id_categoria_serie');

            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categorie')
                  ->cascadeOnDelete();// Collego la categoria alla tabella categorie e faccio eliminare automaticamente i record collegati quando la categoria viene cancellata


            $table->unsignedBigInteger('id_serie');
            $table->foreign('id_serie')
                  ->references('id_serie')
                  ->on('serie')
                  ->cascadeOnDelete();// Collego la serie alla tabella serie e faccio eliminare automaticamente i record collegati quando la serie viene cancellata


            // Evito duplicati (una categoria collegata più volte alla stessa serie)
            $table->unique(['id_categoria', 'id_serie'], 'uniq_categoria_serie');

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
        Schema::dropIfExists('categoria_serie');
    }
};
