<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoIndirizzoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipi_indirizzi';
    protected $primaryKey = 'id_tipo_indirizzo';

    protected $fillable = [
        'tipo',

    ];

    public function indirizzi()
    {
        return $this->hasMany(IndirizzoModel::class, 'id_tipo_indirizzo', 'id_tipo_indirizzo');
    }
}
