<?php
// app/Models/TassoCambioModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TassoCambioModel extends Model
{
    protected $table = 'tassi_cambio'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_tasso_cambio'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_valuta',
        'tasso'
    ];

    /**
     * Relazione: il tasso di cambio appartiene a una valuta.
     *
     * @return BelongsTo
     */
    public function valuta()
    {
        return $this->belongsTo(ValutaModel::class, 'id_valuta');
    }
}
