<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbilitaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'abilita';
    protected $primaryKey = 'id_abilita';

    protected $fillable = [
        'nome',
        'sku',

    ];

    public function ruoli()
    {
        return $this->belongsToMany(RuoloModel::class, 'ruoli_abilita', 'id_abilita', 'id_ruolo');
    }
}
