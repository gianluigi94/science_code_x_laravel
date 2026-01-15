<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoRecapitoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipi_recapiti'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_tipo_recapito'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'tipo',
    ];

    /**
     * Relazione: il tipo di recapito è associato a molti recapiti.
     *
     * @return HasMany
     */
    public function recapiti()
    {
        return $this->hasMany(RecapitoModel::class, 'id_tipo_recapito', 'id_tipo_recapito');
    }
}
