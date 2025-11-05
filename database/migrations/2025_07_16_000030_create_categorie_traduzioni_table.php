<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categorie_traduzioni', function (Blueprint $table) {
            $table->id('id_categoria_traduzione');

            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_lingua');

            $table->string('nome', 100);

            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categorie')
                  ->cascadeOnDelete();

            $table->foreign('id_lingua')
                  ->references('id_lingua')
                  ->on('lingue')
                  ->cascadeOnDelete();

            $table->unique(['id_categoria', 'id_lingua'], 'uniq_categoria_lingua');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorie_traduzioni');
    }
};
