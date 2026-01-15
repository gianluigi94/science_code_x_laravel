<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndirizzoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'indirizzi'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_indirizzo'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_contatto',
        'id_tipo_indirizzo',
        'id_nazione',
        'id_comune',
        'cap',
        'indirizzo',
        'civico',
    ];

    /**
     * Relazione: l'indirizzo appartiene a un contatto.
     *
     * @return BelongsTo
     */
    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }

    /**
     * Relazione: l'indirizzo appartiene a un tipo di indirizzo.
     *
     * @return BelongsTo
     */
    public function tipoIndirizzo()
    {
        return $this->belongsTo(TipoIndirizzoModel::class, 'id_tipo_indirizzo', 'id_tipo_indirizzo');
    }

    /**
     * Relazione: l'indirizzo appartiene a un comune.
     *
     * @return BelongsTo
     */
    public function comune()
    {
        return $this->belongsTo(ComuneModel::class, 'id_comune', 'id_comune');
    }

    /**
     * Relazione: l'indirizzo appartiene a una nazione.
     *
     * @return BelongsTo
     */
    public function nazione()
    {
        return $this->belongsTo(NazioneModel::class, 'id_nazione', 'id_nazione');
    }
}
