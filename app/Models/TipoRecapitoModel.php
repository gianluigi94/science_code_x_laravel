<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoRecapitoModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipi_recapiti';
    protected $primaryKey = 'id_tipo_recapito';

    protected $fillable = [
        'tipo',
    ];

    public function recapiti()
    {
        return $this->hasMany(RecapitoModel::class, 'id_tipo_recapito', 'id_tipo_recapito');
    }
}
