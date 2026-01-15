<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TraduzioneCustomModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'traduzioni_custom'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_traduzione_custom'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'chiave',
        'id_lingua',
        'valore'
    ];


    /**
     * Relazione: la traduzione personalizzata appartiene a una lingua.
     *
     * @return BelongsTo
     */
    public function lingua()
    {
        return $this->belongsTo(LinguaModel::class, 'id_lingua', 'id_lingua');
    }
}
