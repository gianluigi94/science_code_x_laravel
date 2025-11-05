<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuoloAbilitaModel extends Model
{
    use HasFactory;

    protected $table = 'ruoli_abilita';

    protected $fillable = [
        'id_abilita',
        'id_ruolo',

    ];

    public function ruolo()
    {
        return $this->belongsTo(RuoloModel::class, 'id_ruolo', 'id_ruolo');
    }

    public function abilita()
    {
        return $this->belongsTo(AbilitaModel::class, 'id_abilita', 'id_abilita');
    }
}
