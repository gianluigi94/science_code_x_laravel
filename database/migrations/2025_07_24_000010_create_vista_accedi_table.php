<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_accedi");
    }
};
