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
        Schema::create('recapiti', function (Blueprint $table) {
            $table->id('id_recapito');
            $table->unsignedBigInteger('id_contatto');
            $table->foreign('id_contatto')->references('id_contatto')->on('contatti')->cascadeOnDelete();

            $table->unsignedBigInteger('id_tipo_recapito');
            $table->foreign('id_tipo_recapito')->references('id_tipo_recapito')->on('tipi_recapiti');

            $table->string('recapito', 255);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recapiti');
    }
};
