<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('traduzioni', function (Blueprint $table) {
            $table->id('id_traduzione');
            $table->string('chiave', 190);
            $table->unsignedBigInteger('id_lingua');
            $table->text('valore')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['chiave', 'id_lingua']);
            $table->foreign('id_lingua')->references('id_lingua')->on('lingue')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('traduzioni');
    }
};
