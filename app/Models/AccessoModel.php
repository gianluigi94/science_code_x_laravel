<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'accessi'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_accesso'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_contatto',
        'indirizzo_ip',
        'successo',
    ];

    /**
     * Relazione: l'accesso appartiene a un contatto.
     *
     * @return BelongsTo
     */
    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }


    /**
     * Registra un tentativo di accesso fallito.
     *
     * @param int|null $id_contatto
     * @return AccessoModel
     */
    public static function aggiungi_tentativo_fallito($id_contatto)
    {
        return AccessoModel::nuovo_record($id_contatto, 0);
    }

    /**
     * Crea un record accesso (successo/fallimento) con IP corrente.
     *
     * @param int|null $id_contatto
     * @param int|bool $successo
     * @return AccessoModel
     */
    public static function nuovo_record($id_contatto, $successo)
    {
        $ip_address = request()->ip() ?? $_SERVER['REMOTE_ADDR'];

        $tmp = AccessoModel::create([
            'id_contatto' => $id_contatto,
            'successo' => $successo,
            'indirizzo_ip' => $ip_address
        ]);

        return $tmp;
    }

    /**
     * Elimina i tentativi falliti recenti (finestra blocco_psw) per contatto e per IP anonimo.
     *
     * @param int|null $id_contatto
     * @return int
     */
    public static function elimina_tentativi($id_contatto)
    {
        $cutoff = now()->subSeconds(ConfigurazioneModel::leggi_valore('blocco_psw'));
        $indirizzo_ip = request()->ip() ?? $_SERVER['REMOTE_ADDR'];

        $eliminati_id_contatto = AccessoModel::where('id_contatto', $id_contatto)
            ->where('successo', 0)
            ->where('created_at', '>=', $cutoff)
            ->delete();

        $eliminati_ip_null = AccessoModel::whereNull('id_contatto')
            ->where('indirizzo_ip', $indirizzo_ip)
            ->where('successo', 0)
            ->where('created_at', '>=', $cutoff)
            ->delete();

        return $eliminati_id_contatto + $eliminati_ip_null;
    }

    /**
     * Conta i tentativi falliti recenti (finestra blocco_psw) per contatto e per IP anonimo.
     *
     * @param int|null $id_contatto
     * @return int
     */
    public static function conta_tentativi($id_contatto)
    {
        // subSeconds = sottrae un numero di secondi a una data/ora
        $cutoff = now()->subSeconds(ConfigurazioneModel::leggi_valore('blocco_psw'));
        $indirizzo_ip = request()->ip() ?? $_SERVER['REMOTE_ADDR'];// legge l'indirizzo ip della richiesta

        $tentativi_id_contatto = AccessoModel::where('id_contatto', $id_contatto)
            ->where('successo', 0)
            ->where('created_at', '>=', $cutoff)
            ->count();

            //sommo anche id_contatto null ma con lo stesso ip
        $tentativi_ip_null = AccessoModel::whereNull('id_contatto')
            ->where('indirizzo_ip', $indirizzo_ip)
            ->where('successo', 0)
            ->where('created_at', '>=', $cutoff)
            ->count();

        return $tentativi_id_contatto + $tentativi_ip_null;
    }
}
