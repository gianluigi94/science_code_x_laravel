<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaFilmModel extends Model
{
    use SoftDeletes;

    protected $table = 'categoria_film';
    protected $primaryKey = 'id_categoria_film';

    protected $fillable = [
        'id_categoria',
        'id_film',
    ];
}
