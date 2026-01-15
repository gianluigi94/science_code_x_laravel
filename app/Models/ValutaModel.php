<?php
// app/Models/ValutaModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValutaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'valute'; //Nome della vista associata al modello
    protected $primaryKey = 'id_valuta'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'codice_iso',
        'nome',
        'simbolo',
        'decimali',
    ];
}
