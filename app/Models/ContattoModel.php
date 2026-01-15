<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ContattoModel extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'contatti'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_contatto'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'nome',
        'cognome',
        'sesso',
        'codice_fiscale',
        'data_nascita',
        'id_stato_utente',
    ];

    /**
     * Relazione: il contatto appartiene a uno stato utente.
     *
     * @return BelongsTo
     */
    public function statoUtente()
    {
        return $this->belongsTo(StatoUtenteModel::class, 'id_stato_utente', 'id_stato_utente');
    }

    /**
     * Relazione: il contatto ha molti recapiti.
     *
     * @return HasMany
     */
    public function recapiti()
    {
        return $this->hasMany(RecapitoModel::class, 'id_contatto', 'id_contatto');
    }

    /**
     * Relazione: il contatto ha molti indirizzi.
     *
     * @return HasMany
     */
    public function indirizzi()
    {
        return $this->hasMany(IndirizzoModel::class, 'id_contatto', 'id_contatto');
    }

    /**
     * Relazione: il contatto ha molti accessi.
     *
     * @return HasMany
     */
    public function accessi()
    {
        return $this->hasMany(AccessoModel::class, 'id_contatto', 'id_contatto');
    }

    /**
     * Relazione: il contatto ha una password.
     *
     * @return HasOne
     */
    public function password()
    {
        return $this->hasOne(PasswordModel::class, 'id_contatto', 'id_contatto');
    }

    /**
     * Relazione: il contatto ha molte sessioni.
     *
     * @return HasMany
     */
    public function sessioni()
    {
        return $this->hasMany(SessioneModel::class, 'id_contatto', 'id_contatto');
    }

    /**
     * Relazione molti-a-molti con i ruoli tramite tabella contatti_ruoli.
     *
     * @return BelongsToMany
     */
    public function ruoli()
    {
        return $this->belongsToMany(RuoloModel::class, 'contatti_ruoli', 'id_contatto', 'id_ruolo');
    }

    /**
     * Relazione: il contatto ha molte autenticazioni.
     *
     * @return HasMany
     */
    public function autenticazioni()
    {
        return $this->hasMany(AutenticazioneModel::class, 'id_contatto', 'id_contatto');
    }
}
