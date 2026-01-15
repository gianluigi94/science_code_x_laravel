<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VTraduzioneEffettivaModel extends Model
{
    use HasFactory;

    protected $table = 'v_traduzioni_effettive'; //Nome della tabella vista al modello
    protected $primaryKey = 'id_traduzione_effettiva'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'chiave',
        'id_lingua',
        'valore',
        'provenienza_custom',
        'updated_at'
    ];
}
