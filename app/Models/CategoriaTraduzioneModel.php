<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaTraduzioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorie_traduzioni';
    protected $primaryKey = 'id_categoria_traduzione';

    protected $fillable = [
        'id_categoria',
        'id_lingua',
        'nome',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaModel::class, 'id_categoria', 'id_categoria');
    }

    public function lingua()
    {
        return $this->belongsTo(LinguaModel::class, 'id_lingua', 'id_lingua');
    }
}
