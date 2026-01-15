<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'registi'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_regista'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'nome'
    ];

    /**
 * Relazione: il regista ha molti film.
 *
 * @return HasMany
 */
    public function film()
    {
        return $this->hasMany(FilmModel::class, 'id_regista', 'id_regista');
    }

    /**
 * Relazione: il regista ha molte serie.
 *
 * @return HasMany
 */
    public function serie()
    {
        return $this->hasMany(SerieModel::class, 'id_regista', 'id_regista');
    }
}
