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
        Schema::create('sessioni', function (Blueprint $table) {
    $table->id('id_sessione');
    $table->unsignedBigInteger('id_contatto');
    $table->string('token', 512)->nullable();
    $table->boolean('resta_collegato')->default(false);

    $table->softDeletes();
    $table->timestamps();

    $table->foreign('id_contatto')->references('id_contatto')->on('contatti')->cascadeOnDelete();// Collego il contatto e faccio eliminare automaticamente i record collegati quando il contatto viene cancellato

});

    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sessioni');
    }
};
