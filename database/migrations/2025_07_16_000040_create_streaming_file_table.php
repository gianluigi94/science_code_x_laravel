<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Crea la tabella con i suoi relativi campi.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('streaming_file', function (Blueprint $table) {
            $table->id('id_streaming_file');
            $table->string('descrizione', 255)->unique();

            $table->string('url_auto', 512);
            $table->string('url_1080', 512);
            $table->string('url_720', 512);
            $table->string('url_360', 512);

            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('streaming_file');
    }
};
