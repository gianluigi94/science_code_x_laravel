<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecapitoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'recapiti'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_recapito'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_contatto',
        'id_tipo_recapito',
        'recapito'
    ];

    /**
     * Relazione: il recapito appartiene a un contatto.
     *
     * @return BelongsTo
     */
    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }


    /**
     * Relazione: il recapito appartiene a un tipo recapito.
     *
     * @return BelongsTo
     */
    public function tipoRecapito()
    {
        return $this->belongsTo(TipoRecapitoModel::class, 'id_tipo_recapito', 'id_tipo_recapito');
    }
}
