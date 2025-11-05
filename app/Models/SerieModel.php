<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerieModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'serie';
    protected $primaryKey = 'id_serie';

    protected $fillable = [
        'descrizione',
        'id_regista',
        'anno',
        'numero_stagioni',
        'numero_episodi',
        'img_sfondo',
        'novita',
    ];



    public function categorie()
    {
        return $this->belongsToMany(CategoriaModel::class, 'categoria_serie', 'id_serie', 'id_categoria');
    }
    public function traduzioni()
    {
        return $this->hasMany(SerieTraduzioneModel::class, 'id_serie', 'id_serie');
    }
    public function regista()
    {
        return $this->belongsTo(RegistaModel::class, 'id_regista', 'id_regista');
    }
    public function stagioni()
    {
        return $this->hasMany(StagioneModel::class, 'id_serie', 'id_serie');
    }
    public function episodi()
    {
        return $this->hasMany(EpisodioModel::class, 'id_serie', 'id_serie');
    }
}
