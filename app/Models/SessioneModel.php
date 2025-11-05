<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class SessioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sessioni';
    protected $primaryKey = 'id_sessione';

    protected $fillable = [
        'id_contatto',
        'token',
        'resta_collegato'
    ];

    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }

      public static function elimina_sessione($id_contatto)
    {
        DB::table('sessioni')->where('id_contatto', $id_contatto)->delete();
    }


    // aggiorna SOLO l'idle della sessione corrente (non sovrascrive righe)
  public static function aggiorna_sessione($tk)
  {
      DB::table('sessioni')->where('token', $tk)->update(['updated_at' => now()]);
  }

  // crea SEMPRE una nuova riga (nuova sessione) senza toccare le vecchie
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




    public static function dati_sessione($token)
    {
        if (SessioneModel::esiste_sessione($token)) {

            return SessioneModel::where('token', $token)->get()->first();
        } else {
            return null;
        }
    }


    public static function esiste_sessione($token)
    {
        return DB::table("sessioni")->where('token', $token)->exists();
    }
}
