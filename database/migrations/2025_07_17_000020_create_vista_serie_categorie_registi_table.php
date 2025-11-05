<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS `vista_serie_categorie`');
    }
};
