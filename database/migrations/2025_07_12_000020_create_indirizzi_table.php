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
        Schema::create('indirizzi', function (Blueprint $table) {
    $table->id('id_indirizzo');

    $table->unsignedBigInteger('id_contatto');
    $table->foreign('id_contatto')->references('id_contatto')->on('contatti')->cascadeOnDelete();

    $table->unsignedBigInteger('id_tipo_indirizzo');
    $table->foreign('id_tipo_indirizzo')->references('id_tipo_indirizzo')->on('tipi_indirizzi');


    $table->unsignedBigInteger('id_nazione');
    $table->foreign('id_nazione')->references('id_nazione')->on('nazioni');

    $table->unsignedBigInteger('id_comune')->nullable();
    $table->foreign('id_comune')->references('id_comune')->on('comuni');

    $table->string('cap', 10)->nullable();
    $table->string('indirizzo', 255);
    $table->string('civico', 10);

    $table->softDeletes();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indirizzi');
    }
};
