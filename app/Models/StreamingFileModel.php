<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StreamingFileModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'streaming_file'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_streaming_file'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'descrizione',
        'url_auto',
        'url_1080',
        'url_720',
        'url_360',
    ];

    /**
     * Relazione: il file di streaming è associato a molti film.
     *
     * @return HasMany
     */
    public function film()
    {
        return $this->hasMany(FilmModel::class, 'id_streaming_file', 'id_streaming_file');
    }

    /**
     * Relazione: il file di streaming è associato a molti episodi.
     *
     * @return HasMany
     */
    public function episodi()
    {
        return $this->hasMany(EpisodioModel::class, 'id_streaming_file', 'id_streaming_file');
    }
}
