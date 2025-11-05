<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Idempotenza: in caso di deploy multipli
        DB::statement('DROP VIEW IF EXISTS v_traduzioni_con_custom');

        DB::statement(<<<'SQL'
CREATE VIEW v_traduzioni_con_custom AS
SELECT
    t.id_traduzione,
    t.chiave,
    t.id_lingua,
    t.valore AS valore_base,
    c.id_traduzione_custom,
    c.valore AS valore_custom,
    CASE WHEN c.id_traduzione_custom IS NOT NULL THEN 1 ELSE 0 END AS ha_custom,
    t.created_at AS created_at_base,
    t.updated_at AS updated_at_base,
    c.created_at AS created_at_custom,
    c.updated_at AS updated_at_custom
FROM traduzioni t
LEFT JOIN traduzioni_custom c
    ON c.chiave = t.chiave
   AND c.id_lingua = t.id_lingua
   AND c.deleted_at IS NULL
WHERE t.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_traduzioni_con_custom');
    }
};
