<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

       /**
     * Crea la vista `vista_film_categorie_registi`.
     *
     * La vista restituisce :
     * - dati base del film (id_film, img_sfondo),
     * - il nome del regista associato (se presente),
     * - il codice delle categorie associate (0..n categorie).
     *
     * Usa LEFT JOIN per includere comunque il film anche se non ha un regista
     * o non ha categorie collegate. Tutte le tabelle coinvolte vengono filtrate
     * per escludere i record soft-deleted (`deleted_at IS NULL`), inclusa la
     * tabella ponte `categoria_film`.
     *
     * Ogni riga della vista rappresenta una combinazione film–categoria
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement(<<<SQL
CREATE OR REPLACE VIEW `vista_film_categorie_registi` AS
SELECT
    f.id_film,
    f.descrizione,
    r.nome       AS regista_nome,
    c.codice     AS categoria_codice
FROM `film` f
LEFT JOIN `registi` r
    ON r.id_regista = f.id_regista
   AND r.deleted_at IS NULL
LEFT JOIN `categoria_film` cf
    ON cf.id_film = f.id_film
   AND cf.deleted_at IS NULL
LEFT JOIN `categorie` c
    ON c.id_categoria = cf.id_categoria
   AND c.deleted_at IS NULL
WHERE f.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS `vista_film_categorie_registi`');
    }
};
