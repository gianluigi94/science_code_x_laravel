<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorie'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_categoria'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'codice',
    ];

    /**
     * Relazione: la categoria ha molte traduzioni.
     *
     * @return HasMany
     */
    public function traduzioni()
    {
        return $this->hasMany(CategoriaTraduzioneModel::class, 'id_categoria', 'id_categoria');
    }

    /**
     * Relazione molti-a-molti con i film tramite tabella categoria_film.
     *
     * @return BelongsToMany
     */
    public function film()
    {
        return $this->belongsToMany(FilmModel::class, 'categoria_film', 'id_categoria', 'id_film');
    }

    /**
     * Relazione molti-a-molti con le serie tramite tabella categoria_serie.
     *
     * @return BelongsToMany
     */
    public function serie()
    {
        return $this->belongsToMany(SerieModel::class, 'categoria_serie', 'id_categoria', 'id_serie');
    }
}
