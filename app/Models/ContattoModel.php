<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ContattoModel extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'contatti';
    protected $primaryKey = 'id_contatto';

    protected $fillable = [
        'nome',
        'cognome',
        'sesso',
        'codice_fiscale',
        'data_nascita',
        'id_stato_utente',
    ];

    public function statoUtente()
    {
        return $this->belongsTo(StatoUtenteModel::class, 'id_stato_utente', 'id_stato_utente');
    }

    public function recapiti()
    {
        return $this->hasMany(RecapitoModel::class, 'id_contatto', 'id_contatto');
    }

    public function indirizzi()
    {
        return $this->hasMany(IndirizzoModel::class, 'id_contatto', 'id_contatto');
    }

    public function accessi()
    {
        return $this->hasMany(AccessoModel::class, 'id_contatto', 'id_contatto');
    }

    public function password()
    {
        return $this->hasOne(PasswordModel::class, 'id_contatto', 'id_contatto');
    }

    public function sessioni()
    {
        return $this->hasMany(SessioneModel::class, 'id_contatto', 'id_contatto');
    }

    public function ruoli()
    {
        return $this->belongsToMany(RuoloModel::class, 'contatti_ruoli', 'id_contatto', 'id_ruolo');
    }

    public function autenticazioni()
    {
        return $this->hasMany(AutenticazioneModel::class, 'id_contatto', 'id_contatto');
    }
}
