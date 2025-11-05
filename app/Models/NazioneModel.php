<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NazioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nazioni';
    protected $primaryKey = 'id_nazione';

    protected $fillable = [
        'nazione_it',
        'nazione_en',
        'continente',
        'iso',
        'iso3',
        'prefisso_tel',
        'id_valuta'
    ];

    public function indirizzi()
    {
        return $this->hasMany(IndirizzoModel::class, 'id_nazione', 'id_nazione');
    }

    public function aliquota()
    {
        return $this->hasOne(AliquotaModel::class, 'id_nazione', 'id_nazione');
    }

    public function valuta()
{
    return $this->belongsTo(ValutaModel::class, 'id_valuta', 'id_valuta');
}

}
