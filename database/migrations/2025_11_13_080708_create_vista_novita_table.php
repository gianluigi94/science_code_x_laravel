<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    /**
     * Crea la vista `vista_novita`.
     *
     * La vista raccoglie in un'unica query le "novità" provenienti sia dai film
     * sia dalle serie, includendo i contenuti localizzati per lingua.
     *
     * In particolare:
     * - seleziona i record marcati come novità (`novita = 1`) da `film` e `serie`,
     * - unisce le rispettive tabelle di traduzione (`film_traduzioni`, `serie_traduzioni`)
     *   per ottenere titolo, sottotitolo, immagini e trailer,
     * - unisce `lingue` per esporre il codice lingua.
     *
     * Le due selezioni vengono combinate con `UNION ALL` per mantenere tutte le righe
     * (senza eliminare eventuali duplicati). Ogni riga rappresenta un contenuto
     * (film o serie) in una specifica lingua.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement(<<<SQL
CREATE VIEW vista_novita AS
    -- FILM
    SELECT
        f.descrizione      AS descrizione,
        ft.titolo          AS titolo,
        ft.sottotitolo     AS sottotitolo,
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
        st.sottotitolo     AS sottotitolo,
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

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vista_novita');
    }
};
