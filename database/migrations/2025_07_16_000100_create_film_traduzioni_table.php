<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('film_traduzioni', function (Blueprint $table) {
            $table->id('id_film_traduzione');

            $table->unsignedBigInteger('id_film');
            $table->unsignedBigInteger('id_lingua');

            $table->string('titolo', 255);
            $table->string('sottotitolo', 255)->nullable();
            $table->string('trailer', 512)->nullable();
            $table->text('descrizione')->nullable();
            $table->string('img_locandina', 512)->nullable();

            $table->foreign('id_film')
                  ->references('id_film')->on('film')
                  ->cascadeOnDelete();

            $table->foreign('id_lingua')
                  ->references('id_lingua')->on('lingue')
                  ->cascadeOnDelete();

            $table->unique(['id_film', 'id_lingua'], 'uniq_film_lingua');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('film_traduzioni');
    }
};
