<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
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

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_ruoli_abilita");
    }
};
