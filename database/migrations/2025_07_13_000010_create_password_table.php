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
        Schema::create('password', function (Blueprint $table) {
    $table->id('id_password');
    $table->unsignedBigInteger('id_contatto')->unique();
    $table->string('password', 255);
    $table->string('sale', 255)->nullable();
    $table->timestamp('blocco_password')->nullable();
    $table->softDeletes();
    $table->timestamps();

    $table->foreign('id_contatto')->references('id_contatto')->on('contatti')->cascadeOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password');
    }
};
