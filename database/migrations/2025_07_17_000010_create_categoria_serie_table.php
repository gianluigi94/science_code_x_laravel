<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categoria_serie', function (Blueprint $table) {
            $table->id('id_categoria_serie');

            // 🔗 FK verso categorie
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categorie')
                  ->cascadeOnDelete();

            // 🔗 FK verso serie
            $table->unsignedBigInteger('id_serie');
            $table->foreign('id_serie')
                  ->references('id_serie')
                  ->on('serie')
                  ->cascadeOnDelete();

            // Evita duplicati (una categoria collegata più volte alla stessa serie)
            $table->unique(['id_categoria', 'id_serie'], 'uniq_categoria_serie');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categoria_serie');
    }
};
