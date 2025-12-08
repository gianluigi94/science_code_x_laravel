<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'accessi';
    protected $primaryKey = 'id_accesso';

    protected $fillable = [
        'id_contatto',
        'indirizzo_ip',
        'successo',
    ];

    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }


    public static function aggiungi_tentativo_fallito($id_contatto)
    {
        return AccessoModel::nuovo_record($id_contatto, 0);
    }

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

    public static function conta_tentativi($id_contatto)
    {
        $cutoff = now()->subSeconds(ConfigurazioneModel::leggi_valore('blocco_psw'));
        $indirizzo_ip = request()->ip() ?? $_SERVER['REMOTE_ADDR'];

        $tentativi_id_contatto = AccessoModel::where('id_contatto', $id_contatto)
            ->where('successo', 0)
            ->where('created_at', '>=', $cutoff)
            ->count();

        $tentativi_ip_null = AccessoModel::whereNull('id_contatto')
            ->where('indirizzo_ip', $indirizzo_ip)
            ->where('successo', 0)
            ->where('created_at', '>=', $cutoff)
            ->count();

        return $tentativi_id_contatto + $tentativi_ip_null;
    }
}
