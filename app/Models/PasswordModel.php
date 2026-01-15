<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PasswordModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'password'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_password'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_contatto',
        'password',
        'sale',
        'blocco_password'
    ];

    /**
     * Relazione: la password appartiene a un contatto.
     *
     * @return BelongsTo
     */
    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }

    /**
     * Restituisce l'ultima password del contatto (più recente per id_password).
     *
     * @param int $id_contatto
     * @return PasswordModel
     */
    public static function password_attuale($id_contatto)
    {
        $record = PasswordModel::where('id_contatto', $id_contatto)->orderBy('id_password', 'desc')->firstOrFail();
        return $record;
    }
}
