<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'film'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_film'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'descrizione',
        'id_regista',
        'anno',
        'durata',
        'id_streaming_file',
        'novita',
    ];

    /**
     * Relazione molti-a-molti con le categorie tramite tabella categoria_film.
     *
     * @return BelongsToMany
     */
    public function categorie()
    {
        return $this->belongsToMany(CategoriaModel::class, 'categoria_film', 'id_film', 'id_categoria');
    }

    /**
     * Relazione: il film ha molte traduzioni.
     *
     * @return HasMany
     */
    public function traduzioni()
    {
        return $this->hasMany(FilmTraduzioneModel::class, 'id_film', 'id_film');
    }

    /**
     * Relazione: il film appartiene a un regista.
     *
     * @return BelongsTo
     */
    public function regista()
    {
        return $this->belongsTo(RegistaModel::class, 'id_regista', 'id_regista');
    }

    /**
     * Relazione: il film appartiene a un file di streaming.
     *
     * @return BelongsTo
     */
    public function streamingFile()
    {
        return $this->belongsTo(StreamingFileModel::class, 'id_streaming_file', 'id_streaming_file');
    }
}
