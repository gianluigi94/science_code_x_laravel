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
        Schema::create('recapiti', function (Blueprint $table) {
            $table->id('id_recapito');
            $table->unsignedBigInteger('id_contatto');
            $table->foreign('id_contatto')->references('id_contatto')->on('contatti')->cascadeOnDelete();// Collego il contatto e faccio eliminare automaticamente i record collegati quando il contatto viene cancellato


            $table->unsignedBigInteger('id_tipo_recapito');
            $table->foreign('id_tipo_recapito')->references('id_tipo_recapito')->on('tipi_recapiti');// Collego il tipo di recapito alla tabella dei tipi disponibili


            $table->string('recapito', 255);

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
        Schema::dropIfExists('recapiti');
    }
};
