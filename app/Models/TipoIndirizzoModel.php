<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoIndirizzoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipi_indirizzi'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_tipo_indirizzo'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'tipo',
    ];

    /**
     * Relazione: il tipo di indirizzo è associato a molti indirizzi.
     *
     * @return HasMany
     */
    public function indirizzi()
    {
        return $this->hasMany(IndirizzoModel::class, 'id_tipo_indirizzo', 'id_tipo_indirizzo');
    }
}
