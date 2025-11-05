<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement(<<<SQL
CREATE OR REPLACE VIEW `vista_film_categorie_registi` AS
SELECT
    f.id_film,
    f.img_sfondo,
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
