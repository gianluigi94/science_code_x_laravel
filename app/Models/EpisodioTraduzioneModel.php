<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpisodioTraduzioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'episodi_traduzioni';
    protected $primaryKey = 'id_episodio_traduzione';

    protected $fillable = [
        'id_episodio',
        'id_lingua',
        'titolo',
        'descrizione',
    ];

    public function episodio()
    {
        return $this->belongsTo(EpisodioModel::class, 'id_episodio', 'id_episodio');
    }
    public function lingua()
    {
        return $this->belongsTo(LinguaModel::class, 'id_lingua', 'id_lingua');
    }
}
