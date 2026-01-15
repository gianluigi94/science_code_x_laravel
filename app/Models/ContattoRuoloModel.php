<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContattoRuoloModel extends Model
{
    use HasFactory;

    protected $table = 'contatti_ruoli'; //Nome della tabella associata al modello

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_contatto',
        'id_ruolo',
    ];

    /**
 * Relazione: il record appartiene a un contatto.
 *
 * @return BelongsTo
 */
    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }

    /**
 * Relazione: il record appartiene a un ruolo.
 *
 * @return BelongsTo
 */
    public function ruolo()
    {
        return $this->belongsTo(RuoloModel::class, 'id_ruolo', 'id_ruolo');
    }
}
