<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VnovitaModel extends Model
{
    protected $table = 'vista_novita'; //Nome della vista associata al modello

    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'descrizione',
        'titolo',
        'sottotitolo',
        'lingua',
    ];
}
