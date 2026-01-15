<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class AutenticazioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'autenticazioni'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_autenticazione'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_contatto',
        'user',
        'secret_jwt',
        'inizio_sfida',
        'inizio_token'
    ];

    /**
     * Relazione: l'autenticazione appartiene a un contatto.
     *
     * @return BelongsTo
     */
    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }



    /**
     * Verifica se l'utente esiste ed è abilitato al login (se bannato abort 403).
     *
     * @param string $user
     * @return bool
     */
    public static function esistente_utente_valido_per_login($user)
    {
        $utente = DB::table('contatti')
            ->join('autenticazioni', 'contatti.id_contatto', '=', 'autenticazioni.id_contatto')
            ->where('autenticazioni.user', '=', $user)
            ->select('contatti.id_stato_utente', 'autenticazioni.id_contatto')
            ->first();

        if ($utente && $utente->id_stato_utente != 1) {
            abort(403, "ATTENZIONE: UTENTE BANNATO NON HAI PIU' I PERMESSI PER ACCEDERE");
        }

        return ($utente && $utente->id_stato_utente == 1) ? true : false;
    }
}
