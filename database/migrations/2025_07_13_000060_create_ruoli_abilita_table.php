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
        Schema::create('ruoli_abilita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_abilita');
            $table->unsignedBigInteger('id_ruolo');

            $table->foreign('id_abilita')->references('id_abilita')->on('abilita')->cascadeOnDelete();
            $table->foreign('id_ruolo')->references('id_ruolo')->on('ruoli')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruoli_abilita');
    }
};
