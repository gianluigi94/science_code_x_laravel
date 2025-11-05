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
        Schema::create('accessi', function (Blueprint $table) {
            $table->id('id_accesso');
            $table->unsignedBigInteger('id_contatto')->nullable();
            $table->string('indirizzo_ip', 45)->nullable();
            $table->boolean('successo');

            $table->foreign('id_contatto')->references('id_contatto')->on('contatti')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessi');
    }
};
