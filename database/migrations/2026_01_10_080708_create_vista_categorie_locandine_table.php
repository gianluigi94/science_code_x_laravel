<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Aggiorna la vista `vista_categorie_locandine`.
     *
     * Aggiunge:
     * - tipo ('film'|'serie')
     * - id_contenuto (id_film o id_serie)
     *
     * Serve per avere un ordinamento stabile tra lingue.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS vista_categorie_locandine');

        DB::statement(<<<SQL
CREATE VIEW vista_categorie_locandine AS
    -- FILM
    SELECT
        cf.id_categoria     AS id_categoria,
        'film'              AS tipo,
        cf.id_film          AS id_contenuto,
               CASE
         WHEN f.descrizione LIKE 'film.%' THEN REPLACE(f.descrizione, 'film.', '')
         ELSE f.descrizione
       END AS slug,
        l.codice            AS lingua
    FROM categoria_film cf
       INNER JOIN film f
       ON f.id_film = cf.id_film
    INNER JOIN film_traduzioni ft
        ON ft.id_film = cf.id_film
    INNER JOIN lingue l
        ON l.id_lingua = ft.id_lingua
    WHERE cf.deleted_at IS NULL
      AND ft.deleted_at IS NULL
      AND f.deleted_at IS NULL

    UNION ALL

    -- SERIE
    SELECT
        cs.id_categoria     AS id_categoria,
        'serie'             AS tipo,
        cs.id_serie         AS id_contenuto,
               CASE
         WHEN s.descrizione LIKE 'serie.%' THEN REPLACE(s.descrizione, 'serie.', '')
         ELSE s.descrizione
       END AS slug,
        l.codice            AS lingua
    FROM categoria_serie cs
       INNER JOIN serie s
       ON s.id_serie = cs.id_serie
    INNER JOIN serie_traduzioni st
        ON st.id_serie = cs.id_serie
    INNER JOIN lingue l
        ON l.id_lingua = st.id_lingua
    WHERE cs.deleted_at IS NULL
      AND st.deleted_at IS NULL
      AND s.deleted_at IS NULL;
SQL
        );
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vista_categorie_locandine');
    }
};
