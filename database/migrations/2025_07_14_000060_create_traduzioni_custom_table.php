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
        Schema::create('traduzioni_custom', function (Blueprint $table) {
            $table->id('id_traduzione_custom');
            $table->string('chiave', 190);
            $table->unsignedBigInteger('id_lingua');
            $table->text('valore')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['chiave', 'id_lingua']);
            $table->foreign('id_lingua')->references('id_lingua')->on('lingue')->cascadeOnDelete();// Collego la lingua alla tabella delle lingue e faccio eliminare automaticamente i record collegati quando la lingua viene cancellata

        });
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('traduzioni_custom');
    }
};
