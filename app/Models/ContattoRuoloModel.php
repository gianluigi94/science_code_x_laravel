<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContattoRuoloModel extends Model
{
    use HasFactory;

    protected $table = 'contatti_ruoli';

    protected $fillable = [
        'id_contatto',
        'id_ruolo',

    ];

    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }

    public function ruolo()
    {
        return $this->belongsTo(RuoloModel::class, 'id_ruolo', 'id_ruolo');
    }
}
