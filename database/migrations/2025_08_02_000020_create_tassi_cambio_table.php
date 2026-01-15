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
        Schema::create('tassi_cambio', function (Blueprint $table) {
            $table->id('id_tasso_cambio');
            $table->foreignId('id_valuta')
                  ->constrained('valute', 'id_valuta')
                  ->cascadeOnDelete()
                  ->unique(); // Collego la valuta alla tabella valute, elimino i record collegati se la valuta viene cancellata e obbligo l'unicità del collegamento

            $table->decimal('tasso', 18, 8);
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
        Schema::dropIfExists('tassi_cambio');
    }
};
