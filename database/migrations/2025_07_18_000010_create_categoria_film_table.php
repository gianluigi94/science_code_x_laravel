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
        Schema::create('categoria_film', function (Blueprint $table) {
    $table->id('id_categoria_film');

    $table->unsignedBigInteger('id_categoria');
    $table->foreign('id_categoria')
          ->references('id_categoria')
          ->on('categorie')
          ->cascadeOnDelete();// Collego la categoria alla tabella categorie e faccio eliminare automaticamente i record collegati quando la categoria viene cancellata


    $table->unsignedBigInteger('id_film');
    $table->foreign('id_film')
          ->references('id_film')
          ->on('film')
          ->cascadeOnDelete();// Collego il film alla tabella film e faccio eliminare automaticamente i record collegati quando il film viene cancellato


    // Evito duplicati
    $table->unique(['id_categoria', 'id_film'], 'uniq_categoria_film');

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
        Schema::dropIfExists('categoria_film');
    }
};
