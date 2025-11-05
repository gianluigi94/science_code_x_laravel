<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StreamingFileModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'streaming_file';
    protected $primaryKey = 'id_streaming_file';

    protected $fillable = [
        'descrizione',
        'url_auto',
        'url_1080',
        'url_720',
        'url_360',
    ];

    public function film()
    {
        return $this->hasMany(FilmModel::class, 'id_streaming_file', 'id_streaming_file');
    }
    public function episodi()
    {
        return $this->hasMany(EpisodioModel::class, 'id_streaming_file', 'id_streaming_file');
    }
}
