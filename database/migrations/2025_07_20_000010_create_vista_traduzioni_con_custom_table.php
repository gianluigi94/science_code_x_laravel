<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    /**
     * Crea la vista `v_traduzioni_con_custom`.
     *
     * La vista unisce le traduzioni "base" (`traduzioni`) con eventuali override
     * definiti in `traduzioni_custom` per la stessa coppia (chiave, lingua).
     *
     * Per ogni traduzione base espone:
     * - `valore_base` (sempre presente),
     * - `valore_custom` e i relativi metadati (se esiste un override non soft-deleted),
     * - il flag `ha_custom` (1 se l'override esiste, altrimenti 0),
     * - i timestamp di creazione/aggiornamento sia della base che del custom.
     *
     * Usa LEFT JOIN per mantenere tutte le traduzioni base anche quando non
     * esiste una versione custom. Sono esclusi i record soft-deleted
     * sia per la base che per il custom.
     *
     * @return void
     */
    public function up(): void
    {

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

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_traduzioni_con_custom');
    }
};
