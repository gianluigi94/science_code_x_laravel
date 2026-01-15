<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class SessioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sessioni'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_sessione'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'id_contatto',
        'token',
        'resta_collegato'
    ];

    /**
     * Relazione: la sessione appartiene a un contatto.
     *
     * @return BelongsTo
     */
    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }

    /**
     * Elimina tutte le sessioni associate a un contatto.
     *
     * @param int $id_contatto
     * @return void
     */
    public static function elimina_sessione($id_contatto)
    {
        DB::table('sessioni')->where('id_contatto', $id_contatto)->delete();
    }

    /**
     * Aggiorna la data di ultimo aggiornamento della sessione identificata dal token.
     *
     * @param string $tk
     * @return void
     */


    /**
     * Crea una nuova sessione per un contatto, salvando token e preferenza di permanenza.
     *
     * @param int $id_contatto
     * @param string $tk
     * @param bool $resta_collegato
     * @return void
     */
    public static function crea_sessione($id_contatto, $tk, $resta_collegato = false)
    {
        DB::table('sessioni')->insert([
            'id_contatto'     => $id_contatto,
            'token'           => $tk,
            'resta_collegato' => $resta_collegato,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);
    }


    /**
     * Recupera i dati della sessione a partire dal token.
     *
     * @param string $token
     * @return self|null
     */
   public static function dati_sessione($token)
{
    Log::info('DB_CHECK_PRIMA_SESSIONE', [
         'env_file' => base_path('.env'),
         'env_exists' => file_exists(base_path('.env')),
         'env_readable' => is_readable(base_path('.env')),
         'cfg_user' => config('database.connections.mysql.username'),
         'cfg_db' => config('database.connections.mysql.database'),
        'db_user_runtime' => DB::connection('mysql')->getConfig('username'),
        'db_db_runtime' => DB::connection('mysql')->getConfig('database'),
    ]);

    return self::where('token', $token)->first();
}


    /**
     * Verifica se esiste una sessione associata al token.
     *
     * @param string $token
     * @return bool
     */
    public static function esiste_sessione($token)
    {
        return self::where('token', $token)->exists();
    }
}
