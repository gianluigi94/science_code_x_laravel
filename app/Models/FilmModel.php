<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'film';
    protected $primaryKey = 'id_film';

    protected $fillable = [
        'descrizione',
        'id_regista',
        'anno',
        'durata',
        'img_sfondo',
        'id_streaming_file',
        'novita',
    ];

    public function categorie()
    {
        return $this->belongsToMany(CategoriaModel::class, 'categoria_film', 'id_film', 'id_categoria');
    }
    public function traduzioni()
    {
        return $this->hasMany(FilmTraduzioneModel::class, 'id_film', 'id_film');
    }
    public function regista()
    {
        return $this->belongsTo(RegistaModel::class, 'id_regista', 'id_regista');
    }
    public function streamingFile()
    {
        return $this->belongsTo(StreamingFileModel::class, 'id_streaming_file', 'id_streaming_file');
    }
}
