<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbilitaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'abilita'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_abilita'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'nome',
        'sku',
    ];

    /**
     * Relazione molti-a-molti con i ruoli tramite tabella ruoli_abilita.
     *
     * @return BelongsToMany
     */
    public function ruoli()
    {
        return $this->belongsToMany(RuoloModel::class, 'ruoli_abilita', 'id_abilita', 'id_ruolo');
    }
}
