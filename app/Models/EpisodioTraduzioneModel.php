<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpisodioTraduzioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'episodi_traduzioni'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_episodio_traduzione'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_episodio',
        'id_lingua',
        'titolo',
        'descrizione',
    ];

    /**
     * Relazione: la traduzione appartiene a un episodio.
     *
     * @return BelongsTo
     */
    public function episodio()
    {
        return $this->belongsTo(EpisodioModel::class, 'id_episodio', 'id_episodio');
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
