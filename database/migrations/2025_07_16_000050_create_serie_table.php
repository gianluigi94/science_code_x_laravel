<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('serie', function (Blueprint $table) {
            $table->id('id_serie');
             $table->string('descrizione', 255)->unique();
            // 🔗 Solo FK registi (la categoria sarà gestita nella tabella pivot)
            $table->unsignedBigInteger('id_regista');
            $table->foreign('id_regista')
                  ->references('id_regista')
                  ->on('registi')
                  ->cascadeOnDelete();

            // 📅 Dati principali
            $table->unsignedSmallInteger('anno');
            $table->unsignedSmallInteger('numero_stagioni');
            $table->unsignedSmallInteger('numero_episodi');

            // 🖼️ Immagine di sfondo (una sola per serie)
            $table->string('img_sfondo', 512);

            // 🌟 Flag novità
            $table->boolean('novita')->default(false)->index();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serie');
    }
};
