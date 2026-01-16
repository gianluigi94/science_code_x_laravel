<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerieTraduzioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'serie_traduzioni'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_serie_traduzione'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_serie',
        'id_lingua',
        'titolo',
        'sottotitolo',
        'descrizione',
    ];

    /**
     * Relazione: la traduzione appartiene a una serie.
     *
     * @return BelongsTo
     */
    public function serie()
    {
        return $this->belongsTo(SerieModel::class, 'id_serie', 'id_serie');
    }

     /**
     * Relazione: la traduzione appartiene a una lingua.
     *
     * @return BelongsTo
     */
    public function lingua()
    {
        return $this->belongsTo(LinguaModel::class, 'id_lingua', 'id_lingua');
    }
}
