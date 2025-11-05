<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComuneModel extends Model
{
    use HasFactory,SoftDeletes;

     protected $table = 'comuni';
    protected $primaryKey = 'id_comune';

    protected $fillable = [
        'comune',
        'regione',
        'sigla_automobilistica',
        'codice_belfiore',
        'lat',
        'lon',
        'is_capoluogo',
        'multi_cap',
        'cap',
        'cap_inizio',
        'cap_fine',
        'codice_istat'
    ];

    public function indirizzi()
{
    return $this->hasMany(IndirizzoModel::class, 'id_comune', 'id_comune');
}


}

