<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('serie_traduzioni', function (Blueprint $table) {
            $table->id('id_serie_traduzione');

            $table->unsignedBigInteger('id_serie');
            $table->unsignedBigInteger('id_lingua');

            // PRIMA: $table->string('titolo', 255);
            // ORA: separiamo immagine titolo vs testo titolo
            $table->string('img_titolo', 255)->nullable(); // path immagine titolo
            $table->string('titolo', 255);                  // testo del titolo

            $table->string('sottotitolo', 255)->nullable();
            $table->string('trailer', 512)->nullable();       // URL trailer localizzato
            $table->text('descrizione')->nullable();
            $table->string('img_locandina', 512)->nullable(); // URL locandina localizzata

            // FK
            $table->foreign('id_serie')
                  ->references('id_serie')
                  ->on('serie')
                  ->cascadeOnDelete();

            $table->foreign('id_lingua')
                  ->references('id_lingua')
                  ->on('lingue')
                  ->cascadeOnDelete();

            // Evita doppioni stessa lingua per stessa serie
            $table->unique(['id_serie', 'id_lingua'], 'uniq_serie_lingua');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serie_traduzioni');
    }
};
