<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuoloAbilitaModel extends Model
{
    use HasFactory;

    protected $table = 'ruoli_abilita'; //Nome della tabella associata al modello

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_abilita',
        'id_ruolo',

    ];

    /**
 * Relazione: il record di collegamento appartiene a un ruolo.
 *
 * @return BelongsTo
 */
    public function ruolo()
    {
        return $this->belongsTo(RuoloModel::class, 'id_ruolo', 'id_ruolo');
    }

    /**
 * Relazione: il record di collegamento appartiene a un'abilità.
 *
 * @return BelongsTo
 */
    public function abilita()
    {
        return $this->belongsTo(AbilitaModel::class, 'id_abilita', 'id_abilita');
    }
}
