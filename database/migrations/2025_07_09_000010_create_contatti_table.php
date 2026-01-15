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
        Schema::create('contatti', function (Blueprint $table) {
            $table->id('id_contatto');
            $table->string('nome', 100);
            $table->string('cognome', 100);
            $table->tinyInteger('sesso')->unsigned(); //no negativi
            $table->char('codice_fiscale', 16)->unique(); //lo stesso codice fiscale non può comparire più volte
            $table->date('data_nascita');
            $table->unsignedBigInteger('id_stato_utente')->nullable();
            $table->foreign('id_stato_utente')->references('id_stato_utente')->on('stati_utenti'); // Collego lo stato utente del contatto alla tabella stati_utenti


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('contatti');
    }
};
