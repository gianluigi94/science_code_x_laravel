<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinguaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lingue'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_lingua'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'codice',
        'nome',
    ];


    /**
     * Relazione: la lingua ha molte traduzioni.
     *
     * @return HasMany
     */
    public function traduzioni()
    {
        return $this->hasMany(TraduzioneModel::class, 'id_lingua', 'id_lingua');
    }

    /**
     * Relazione: la lingua ha molte traduzioni custom.
     *
     * @return HasMany
     */
    public function traduzioniCustom()
    {
        return $this->hasMany(TraduzioneCustomModel::class, 'id_lingua', 'id_lingua');
    }

    /**
     * Relazione: la lingua ha molte traduzioni categorie.
     *
     * @return HasMany
     */
    public function categorieTradotte()
    {
        return $this->hasMany(CategoriaTraduzioneModel::class, 'id_lingua', 'id_lingua');
    }

    /**
     * Relazione: la lingua ha molte traduzioni film.
     *
     * @return HasMany
     */
    public function filmTraduzioni()
    {
        return $this->hasMany(FilmTraduzioneModel::class, 'id_lingua', 'id_lingua');
    }

    /**
     * Relazione: la lingua ha molte traduzioni serie.
     *
     * @return HasMany
     */
    public function serieTraduzioni()
    {
        return $this->hasMany(SerieTraduzioneModel::class, 'id_lingua', 'id_lingua');
    }

    /**
     * Relazione: la lingua ha molte traduzioni episodi.
     *
     * @return HasMany
     */
    public function episodiTraduzioni()
    {
        return $this->hasMany(EpisodioTraduzioneModel::class, 'id_lingua', 'id_lingua');
    }
}
