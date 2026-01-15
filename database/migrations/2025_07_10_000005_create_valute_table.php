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
        Schema::create('valute', function (Blueprint $table) {
            $table->id('id_valuta');
            $table->char('codice_iso', 3)->unique(); //non ci possono essere più codici iso uguali
            $table->string('nome', 60);
            $table->string('simbolo', 8);
            $table->tinyInteger('decimali')->default(2);
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
        Schema::dropIfExists('valute');
    }
};
