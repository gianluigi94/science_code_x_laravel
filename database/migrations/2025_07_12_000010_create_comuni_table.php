<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabella con i suoi relativi campi.
     *
     * @return void
     */
    public function up(): void
    {
          Schema::create('comuni', function (Blueprint $table) {
            $table->id('id_comune');

            $table->string('comune', 45);
            $table->string('regione', 45);
            $table->string('sigla_automobilistica', 2);
            $table->string('codice_belfiore', 4);

            $table->decimal('lat', 10, 7);
            $table->decimal('lon', 10, 7);

            $table->boolean('is_capoluogo')->default(false);
            $table->boolean('multi_cap')->default(false);

            $table->string('cap', 5);
            $table->string('cap_inizio', 5)->nullable();
            $table->string('cap_fine', 5)->nullable();

            $table->string('codice_istat', 6)->unique();

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
        Schema::dropIfExists('comuni');
    }
};
