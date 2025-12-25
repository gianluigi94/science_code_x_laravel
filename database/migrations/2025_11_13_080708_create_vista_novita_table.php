<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<SQL
CREATE VIEW vista_novita AS
    -- FILM
    SELECT
        f.descrizione      AS descrizione,
        ft.titolo          AS titolo,
        ft.img_titolo      AS img_titolo,
        ft.sottotitolo     AS sottotitolo,
        ft.trailer         AS trailer,
        l.codice           AS lingua
    FROM film f
    INNER JOIN film_traduzioni ft
        ON ft.id_film = f.id_film
    INNER JOIN lingue l
        ON l.id_lingua = ft.id_lingua
    WHERE f.novita = 1

    UNION ALL

    -- SERIE
    SELECT
        s.descrizione      AS descrizione,
        st.titolo          AS titolo,
        st.img_titolo      AS img_titolo,
        st.sottotitolo     AS sottotitolo,
        st.trailer         AS trailer,
        l.codice           AS lingua
    FROM serie s
    INNER JOIN serie_traduzioni st
        ON st.id_serie = s.id_serie
    INNER JOIN lingue l
        ON l.id_lingua = st.id_lingua
    WHERE s.novita = 1;
SQL
        );
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vista_novita');
    }
};
