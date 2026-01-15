<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StagioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stagioni'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_stagione';  //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_serie',
        'descrizione',
        'numero_stagione',
        'numero_episodi',
    ];

    /**
     * Relazione: la stagione appartiene a una serie.
     *
     * @return BelongsTo
     */
    public function serie()
    {
        return $this->belongsTo(SerieModel::class, 'id_serie', 'id_serie');
    }

    /**
     * Relazione: la stagione ha molti episodi.
     *
     * @return HasMany
     */
    public function episodi()
    {
        return $this->hasMany(EpisodioModel::class, 'id_stagione', 'id_stagione');
    }
}
