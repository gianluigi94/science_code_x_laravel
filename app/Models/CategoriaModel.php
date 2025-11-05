<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorie';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'codice',
    ];

    public function traduzioni()
    {
        return $this->hasMany(CategoriaTraduzioneModel::class, 'id_categoria', 'id_categoria');
    }

    public function film()
    {
        return $this->belongsToMany(FilmModel::class, 'categoria_film', 'id_categoria', 'id_film');
    }
    public function serie()
    {
        return $this->belongsToMany(SerieModel::class, 'categoria_serie', 'id_categoria', 'id_serie');
    }
}
