<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuoloModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ruoli';
    protected $primaryKey = 'id_ruolo';

    protected $fillable = [
        'ruolo',
    ];

    public function contatti()
    {
        return $this->belongsToMany(ContattoModel::class, 'contatti_ruoli', 'id_ruolo', 'id_contatto');
    }

    public function abilita()
    {
        return $this->belongsToMany(AbilitaModel::class, 'ruoli_abilita', 'id_ruolo', 'id_abilita');
    }
}
