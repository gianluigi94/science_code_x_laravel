<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmTraduzioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'film_traduzioni'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_film_traduzione'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_film',
        'id_lingua',

        'img_titolo',
        'titolo',

        'sottotitolo',
        'trailer',
        'descrizione',
        'img_locandina',
    ];

    /**
     * Relazione: la traduzione appartiene a un film.
     *
     * @return BelongsTo
     */
    public function film()
    {
        return $this->belongsTo(FilmModel::class, 'id_film', 'id_film');
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
