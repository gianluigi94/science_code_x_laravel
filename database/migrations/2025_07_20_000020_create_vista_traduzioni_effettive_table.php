<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

        /**
     * Crea la vista `v_traduzioni_effettive`.
     *
     * La vista restituisce, per ogni coppia (chiave, lingua), la traduzione
     * "effettiva" da usare nell'applicazione:
     * - se esiste una traduzione custom non soft-deleted e con valore non NULL,
     *   viene usato `traduzioni_custom.valore`;
     * - altrimenti viene usato `traduzioni.valore` (valore base).
     *
     * Espone inoltre:
     * - `provenienza_custom` (1 se la traduzione proviene dal custom, altrimenti 0),
     * - `updated_at` calcolato come l'ultimo aggiornamento tra custom e base
     *
     * Il LEFT JOIN mantiene tutte le traduzioni base anche in assenza di override,
     * ed esclude i record soft-deleted tramite.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_traduzioni_effettive');

        DB::statement(<<<'SQL'
CREATE VIEW v_traduzioni_effettive AS
SELECT
    t.id_traduzione AS id_traduzione_effettiva,
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

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_traduzioni_effettive');
    }
};
