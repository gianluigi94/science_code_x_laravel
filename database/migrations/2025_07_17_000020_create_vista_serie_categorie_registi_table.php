<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

       /**
     * Crea la vista `vista_serie_categorie_registi`.
     *
     * La vista espone:
     * - dati base della serie (id_serie, img_sfondo),
     * - il nome del regista associato ,
     * - il codice delle categorie associate .
     *
     * Usa LEFT JOIN per includere comunque la serie anche se non ha un regista
     * o non ha categorie collegate. Tutte le entità vengono filtrate per
     * escludere i record soft-deleted, inclusa la tabella
     * ponte `categoria_serie`.
     *
     * Ogni riga della vista rappresenta una combinazione serie–categoria
     *
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement(<<<SQL
CREATE OR REPLACE VIEW `vista_serie_categorie_registi` AS
SELECT
    s.id_serie,
    s.img_sfondo,
    r.nome                AS regista_nome,
    c.codice              AS categoria_codice

FROM `serie` s
LEFT JOIN `registi` r
    ON r.id_regista = s.id_regista
   AND r.deleted_at IS NULL
LEFT JOIN `categoria_serie` cs
    ON cs.id_serie = s.id_serie
   AND cs.deleted_at IS NULL
LEFT JOIN `categorie` c
    ON c.id_categoria = cs.id_categoria
   AND c.deleted_at IS NULL
WHERE s.deleted_at IS NULL
SQL);
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS `vista_serie_categorie_registi`');

    }
};
