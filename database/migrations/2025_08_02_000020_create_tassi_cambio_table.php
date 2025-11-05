<?php
// database/migrations/2025_11_02_000100_create_tassi_cambio_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tassi_cambio', function (Blueprint $table) {
            $table->id('id_tasso_cambio');
            $table->foreignId('id_valuta')
                  ->constrained('valute', 'id_valuta')
                  ->cascadeOnDelete()
                  ->unique(); // 1 sola riga per valuta
            $table->decimal('tasso', 18, 8); // EUR base=1.00000000
            $table->timestamps(); // usiamo updated_at come "data tasso"
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tassi_cambio');
    }
};
