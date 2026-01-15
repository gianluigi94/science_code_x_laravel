<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Crea la vista `vista_ruoli_abilita`.
     *
     * La vista restituisce l'elenco delle abilità associate a ciascun ruolo,
     * combinando le tabelle `ruoli`, `abilita` e `ruoli_abilita`.
     * Ogni riga rappresenta una coppia ruolo–abilità, ordinata per ruolo
     * e per abilità, ed è pensata per semplificare interrogazioni di lettura
     * e reportistica sui permessi del sistema.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW vista_ruoli_abilita AS
            SELECT
                r.ruolo,
                a.nome AS nome_abilita
            FROM ruoli_abilita ra
            INNER JOIN ruoli r ON ra.id_ruolo = r.id_ruolo
            INNER JOIN abilita a ON ra.id_abilita = a.id_abilita
            ORDER BY r.id_ruolo, a.id_abilita;
        ");
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_ruoli_abilita");
    }
};
