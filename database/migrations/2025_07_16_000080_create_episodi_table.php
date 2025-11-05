<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('episodi', function (Blueprint $table) {
            $table->id('id_episodio');

            // FK stagione
            $table->unsignedBigInteger('id_stagione');
            $table->foreign('id_stagione')
                  ->references('id_stagione')
                  ->on('stagioni')
                  ->cascadeOnDelete();


             $table->unsignedBigInteger('id_serie');
            $table->foreign('id_serie')
                  ->references('id_serie')
                  ->on('serie')
                  ->cascadeOnDelete();





            $table->string('descrizione', 255)->unique();

            // Dati fissi episodio
            $table->unsignedSmallInteger('numero_episodio'); // 1,2,3...
            $table->unsignedInteger('durata');// minuti
            $table->string('img_anteprima', 512);

            // FK streaming_file (multi-qualità)
            $table->unsignedBigInteger('id_streaming_file');
            $table->foreign('id_streaming_file')
                  ->references('id_streaming_file')
                  ->on('streaming_file')
                  ->cascadeOnDelete();

            // Evita doppioni (stessa stagione, stesso numero)
            $table->unique(['id_stagione', 'numero_episodio'], 'uniq_stagione_ep');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('episodi');
    }
};
