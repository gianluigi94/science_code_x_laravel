<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    /**
     * Crea la vista `vista_prezzi`.
     *
     * La vista fornisce, per ciascuna nazione attiva, le informazioni utili al calcolo
     * dei prezzi/localizzazione economica:
     * - nome della nazione (`nazione_it`),
     * - nome della valuta associata,
     * - tasso di cambio della valuta,
     * - aliquota associata alla nazione.
     *
     * Usa LEFT JOIN per includere comunque la nazione anche se mancano valuta, tasso
     * o aliquota. I record soft-deleted vengono esclusi
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement(<<<SQL
CREATE VIEW vista_prezzi AS
SELECT
  n.nazione_it,
  v.nome AS valuta_nome,
  tc.tasso,
  a.aliquota
FROM nazioni n
LEFT JOIN valute v
  ON v.id_valuta = n.id_valuta
  AND v.deleted_at IS NULL
LEFT JOIN tassi_cambio tc
  ON tc.id_valuta = v.id_valuta
LEFT JOIN aliquote a
  ON a.id_nazione = n.id_nazione
  AND a.deleted_at IS NULL
WHERE n.deleted_at IS NULL
SQL);
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vista_prezzi');
    }
};
