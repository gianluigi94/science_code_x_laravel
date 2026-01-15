<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerieModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'serie'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_serie'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'descrizione',
        'id_regista',
        'anno',
        'numero_stagioni',
        'numero_episodi',
        'img_sfondo',
        'novita',
    ];



    /**
     * Relazione molti-a-molti con le categorie tramite tabella categoria_serie.
     *
     * @return BelongsToMany
     */
    public function categorie()
    {
        return $this->belongsToMany(CategoriaModel::class, 'categoria_serie', 'id_serie', 'id_categoria');
    }

    /**
     * Relazione: la serie ha molte traduzioni.
     *
     * @return HasMany
     */
    public function traduzioni()
    {
        return $this->hasMany(SerieTraduzioneModel::class, 'id_serie', 'id_serie');
    }

    /**
     * Relazione: la serie appartiene a un regista.
     *
     * @return BelongsTo
     */
    public function regista()
    {
        return $this->belongsTo(RegistaModel::class, 'id_regista', 'id_regista');
    }

    /**
     * Relazione: la serie ha molte stagioni.
     *
     * @return HasMany
     */
    public function stagioni()
    {
        return $this->hasMany(StagioneModel::class, 'id_serie', 'id_serie');
    }

    /**
     * Relazione: la serie ha molti episodi.
     *
     * @return HasMany
     */
    public function episodi()
    {
        return $this->hasMany(EpisodioModel::class, 'id_serie', 'id_serie');
    }
}
