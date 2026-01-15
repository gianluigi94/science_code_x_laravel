<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatoUtenteModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stati_utenti'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_stato_utente'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'stato',
    ];

    /**
     * Relazione: lo stato utente è associato a molti contatti.
     *
     * @return HasMany
     */
    public function contatti()
    {
        return $this->hasMany(ContattoModel::class, 'id_stato_utente', 'id_stato_utente');
    }
}
