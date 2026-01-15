<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NazioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nazioni'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_nazione'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'nazione_it',
        'nazione_en',
        'continente',
        'iso',
        'iso3',
        'prefisso_tel',
        'id_valuta'
    ];

    /**
     * Relazione: la nazione ha molti indirizzi.
     *
     * @return HasMany
     */
    public function indirizzi()
    {
        return $this->hasMany(IndirizzoModel::class, 'id_nazione', 'id_nazione');
    }

    /**
     * Relazione: la nazione ha una aliquota.
     *
     * @return HasOne
     */
    public function aliquota()
    {
        return $this->hasOne(AliquotaModel::class, 'id_nazione', 'id_nazione');
    }

    /**
     * Relazione: la nazione appartiene a una valuta.
     *
     * @return BelongsTo
     */
    public function valuta()
    {
        return $this->belongsTo(ValutaModel::class, 'id_valuta', 'id_valuta');
    }
}
