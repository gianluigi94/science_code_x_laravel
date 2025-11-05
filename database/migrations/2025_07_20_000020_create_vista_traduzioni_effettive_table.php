<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_traduzioni_effettive');

        DB::statement(<<<'SQL'
CREATE VIEW v_traduzioni_effettive AS
SELECT
    t.id_traduzione AS id_traduzione_effettiva,  -- <— aggiunto
    t.chiave,
    t.id_lingua,
    CASE
        WHEN c.id_traduzione_custom IS NOT NULL AND c.valore IS NOT NULL THEN c.valore
        ELSE t.valore
    END AS valore,
    CASE WHEN c.id_traduzione_custom IS NOT NULL THEN 1 ELSE 0 END AS provenienza_custom,
    COALESCE(c.updated_at, t.updated_at) AS updated_at
FROM traduzioni t
LEFT JOIN traduzioni_custom c
    ON c.chiave = t.chiave
   AND c.id_lingua = t.id_lingua
   AND c.deleted_at IS NULL
WHERE t.deleted_at IS NULL;

SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_traduzioni_effettive');
    }
};
