<?php
// app/Models/TassoCambioModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TassoCambioModel extends Model
{
    protected $table = 'tassi_cambio';
    protected $primaryKey = 'id_tasso_cambio';
    protected $fillable = ['id_valuta','tasso'];

    public function valuta()
    {
        return $this->belongsTo(ValutaModel::class, 'id_valuta');
    }
}
