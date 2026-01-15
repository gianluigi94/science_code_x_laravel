<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VcategorieLocandineModel extends Model
{
    protected $table = 'vista_categorie_locandine'; //Nome della vista associata al modello

    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_categoria',
                'tipo',
       'id_contenuto',
        'img_locandina',
        'lingua',
    ];
}
