<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    /**
     * Crea la vista `vista_accedi`.
     *
     * La vista aggrega i dati necessari all'autenticazione unendo:
     * - `autenticazioni` (id_contatto, user/username)
     * - `password` (hash password e sale associati allo stesso contatto)
     *
     * Restituisce solo record "attivi" escludendo quelli soft-deleted
     * L'uso di JOIN (INNER JOIN)
     * fa sì che compaiano solo i contatti che hanno sia l'account in
     * `autenticazioni` sia una riga corrispondente in `password`.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW vista_accedi AS
            SELECT
                a.id_contatto,
                a.user,
                p.password,
                p.sale
            FROM autenticazioni a
            JOIN password p ON a.id_contatto = p.id_contatto
            WHERE a.deleted_at IS NULL AND p.deleted_at IS NULL
        ");
    }

    /**
     * Riporta indietro le modifiche fatte dalla migrazione.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_accedi");
    }
};
