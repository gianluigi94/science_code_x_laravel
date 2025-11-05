<?php
// database/migrations/2025_11_02_000001_create_aliquote_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aliquote', function (Blueprint $table) {
            $table->id('id_aliquota');
            $table->unsignedBigInteger('id_nazione');
            $table->decimal('aliquota', 5, 2);
            $table->softDeletes();
            $table->timestamps();

            $table->unique('id_nazione');
            $table->foreign('id_nazione')->references('id_nazione')->on('nazioni')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aliquote');
    }
};
