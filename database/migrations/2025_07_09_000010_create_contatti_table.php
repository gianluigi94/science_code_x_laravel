<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contatti', function (Blueprint $table) {
            $table->id('id_contatto');
            $table->string('nome', 100);
            $table->string('cognome', 100);
            $table->tinyInteger('sesso')->unsigned();
            $table->char('codice_fiscale', 16)->unique();
            $table->date('data_nascita');
            $table->unsignedBigInteger('id_stato_utente')->nullable();
            $table->foreign('id_stato_utente')->references('id_stato_utente')->on('stati_utenti');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatti');
    }
};
