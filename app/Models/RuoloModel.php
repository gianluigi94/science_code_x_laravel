<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuoloModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ruoli'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_ruolo'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'ruolo',
    ];

    /**
     * Relazione molti-a-molti con i contatti tramite tabella contatti_ruoli.
     *
     * @return BelongsToMany
     */
    public function contatti()
    {
        return $this->belongsToMany(ContattoModel::class, 'contatti_ruoli', 'id_ruolo', 'id_contatto');
    }

    /**
     * Relazione molti-a-molti con le abilità tramite tabella ruoli_abilita.
     *
     * @return BelongsToMany
     */
    public function abilita()
    {
        return $this->belongsToMany(AbilitaModel::class, 'ruoli_abilita', 'id_ruolo', 'id_abilita');
    }
}
