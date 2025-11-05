<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stagioni', function (Blueprint $table) {
            $table->id('id_stagione');

            // FK serie
            $table->unsignedBigInteger('id_serie');
            $table->foreign('id_serie')
                  ->references('id_serie')
                  ->on('serie')
                  ->cascadeOnDelete();

            $table->text('descrizione')->nullable();

            // Dati
            $table->unsignedSmallInteger('numero_stagione'); // 1,2,3...
            $table->unsignedSmallInteger('numero_episodi');  // episodi in questa stagione

            // Evita doppioni della stessa stagione per la stessa serie
            $table->unique(['id_serie', 'numero_stagione'], 'uniq_serie_stagione');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stagioni');
    }
};
