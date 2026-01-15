<?php
// app/Models/AliquotaModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AliquotaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aliquote'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_aliquota'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_nazione',
        'aliquota',
    ];

    /**
     * Relazione: l'aliquota appartiene a una nazione.
     *
     * @return BelongsTo
     */
    public function nazione()
    {
        return $this->belongsTo(NazioneModel::class, 'id_nazione', 'id_nazione');
    }
}
