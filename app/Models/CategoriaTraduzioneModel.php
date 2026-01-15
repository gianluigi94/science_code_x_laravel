<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaTraduzioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorie_traduzioni'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_categoria_traduzione'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_categoria',
        'id_lingua',
        'nome',
    ];

    /**
     * Relazione: la traduzione appartiene a una categoria.
     *
     * @return BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(CategoriaModel::class, 'id_categoria', 'id_categoria');
    }

    /**
     * Relazione: la traduzione appartiene a una lingua.
     *
     * @return BelongsTo
     */
    public function lingua()
    {
        return $this->belongsTo(LinguaModel::class, 'id_lingua', 'id_lingua');
    }
}
