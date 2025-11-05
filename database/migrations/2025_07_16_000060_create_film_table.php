<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('film', function (Blueprint $table) {
            $table->id('id_film');
            $table->string('descrizione', 255)->unique();
            // FK registi
            $table->unsignedBigInteger('id_regista');
            $table->foreign('id_regista')
                  ->references('id_regista')
                  ->on('registi')
                  ->cascadeOnDelete();

            // Dati principali
            $table->unsignedSmallInteger('anno');
             $table->unsignedInteger('durata');
            $table->string('img_sfondo', 512);

            // FK streaming_file
            $table->unsignedBigInteger('id_streaming_file');
            $table->foreign('id_streaming_file')
                  ->references('id_streaming_file')
                  ->on('streaming_file')
                  ->cascadeOnDelete();

            // Flag novità
            $table->boolean('novita')->default(false)->index();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('film');
    }
};
