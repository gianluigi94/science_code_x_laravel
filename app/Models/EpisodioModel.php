<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpisodioModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'episodi'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_episodio'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_stagione',
        'id_serie',
        'descrizione',
        'numero_episodio',
        'durata',
        'img_anteprima',
        'id_streaming_file',
    ];

    /**
     * Relazione: l'episodio appartiene a una stagione.
     *
     * @return BelongsTo
     */
    public function stagione()
    {
        return $this->belongsTo(StagioneModel::class, 'id_stagione', 'id_stagione');
    }

    /**
     * Relazione: l'episodio appartiene a una serie.
     *
     * @return BelongsTo
     */
    public function serie()
    {
        return $this->belongsTo(SerieModel::class, 'id_serie', 'id_serie');
    }

    /**
     * Relazione: l'episodio appartiene a un file di streaming.
     *
     * @return BelongsTo
     */
    public function streamingFile()
    {
        return $this->belongsTo(StreamingFileModel::class, 'id_streaming_file', 'id_streaming_file');
    }

    /**
     * Relazione: l'episodio ha molte traduzioni.
     *
     * @return HasMany
     */
    public function traduzioni()
    {
        return $this->hasMany(EpisodioTraduzioneModel::class, 'id_episodio', 'id_episodio');
    }
}
