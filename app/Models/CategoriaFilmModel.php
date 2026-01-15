<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaFilmModel extends Model
{
    use SoftDeletes;

    protected $table = 'categoria_film'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_categoria_film'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_categoria',
        'id_film',
    ];
}
