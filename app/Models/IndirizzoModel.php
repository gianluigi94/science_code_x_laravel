<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndirizzoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'indirizzi';
    protected $primaryKey = 'id_indirizzo';

    protected $fillable = [
        'id_contatto',
        'id_tipo_indirizzo',
        'id_nazione',
        'id_comune',
        'cap',
        'indirizzo',
        'civico',
    ];

    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }

    public function tipoIndirizzo()
    {
        return $this->belongsTo(TipoIndirizzoModel::class, 'id_tipo_indirizzo', 'id_tipo_indirizzo');
    }

    public function comune()
    {
        return $this->belongsTo(ComuneModel::class, 'id_comune', 'id_comune');
    }

    public function nazione()
    {
        return $this->belongsTo(NazioneModel::class, 'id_nazione', 'id_nazione');
    }
}
