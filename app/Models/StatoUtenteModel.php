<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatoUtenteModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stati_utenti';
    protected $primaryKey = 'id_stato_utente';

    protected $fillable = [
        'stato',
    ];
    public function contatti()
    {
        return $this->hasMany(ContattoModel::class, 'id_stato_utente', 'id_stato_utente');
    }
}
