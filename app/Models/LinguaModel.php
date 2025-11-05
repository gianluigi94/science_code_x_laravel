<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinguaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lingue';
    protected $primaryKey = 'id_lingua';

    protected $fillable = [
        'codice',
        'nome',
    ];


    public function traduzioni()
    {
        return $this->hasMany(TraduzioneModel::class, 'id_lingua', 'id_lingua');
    }

    public function traduzioniCustom()
    {
        return $this->hasMany(TraduzioneCustomModel::class, 'id_lingua', 'id_lingua');
    }

    public function categorieTradotte()
    {
        return $this->hasMany(CategoriaTraduzioneModel::class, 'id_lingua', 'id_lingua');
    }

    public function filmTraduzioni()
    {
        return $this->hasMany(FilmTraduzioneModel::class, 'id_lingua', 'id_lingua');
    }
    public function serieTraduzioni()
    {
        return $this->hasMany(SerieTraduzioneModel::class, 'id_lingua', 'id_lingua');
    }
    public function episodiTraduzioni()
    {
        return $this->hasMany(EpisodioTraduzioneModel::class, 'id_lingua', 'id_lingua');
    }
}
