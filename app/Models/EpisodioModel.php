<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpisodioModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'episodi';
    protected $primaryKey = 'id_episodio';

    protected $fillable = [
        'id_stagione',
        'id_serie',
        'descrizione',
        'numero_episodio',
        'durata',
        'img_anteprima',
        'id_streaming_file',
    ];
    public function stagione()
    {
        return $this->belongsTo(StagioneModel::class, 'id_stagione', 'id_stagione');
    }
    public function serie()
    {
        return $this->belongsTo(SerieModel::class, 'id_serie', 'id_serie');
    }
    public function streamingFile()
    {
        return $this->belongsTo(StreamingFileModel::class, 'id_streaming_file', 'id_streaming_file');
    }
    public function traduzioni()
    {
        return $this->hasMany(EpisodioTraduzioneModel::class, 'id_episodio', 'id_episodio');
    }
}
