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
        Schema::create('categoria_film', function (Blueprint $table) {
    $table->id('id_categoria_film');

    // FK categorie
    $table->unsignedBigInteger('id_categoria');
    $table->foreign('id_categoria')
          ->references('id_categoria')
          ->on('categorie')
          ->cascadeOnDelete();

    // FK film
    $table->unsignedBigInteger('id_film');
    $table->foreign('id_film')
          ->references('id_film')
          ->on('film')
          ->cascadeOnDelete();

    // Evita duplicati
    $table->unique(['id_categoria', 'id_film'], 'uniq_categoria_film');

    $table->softDeletes();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_film');
    }
};
