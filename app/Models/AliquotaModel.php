<?php
// app/Models/AliquotaModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AliquotaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aliquote';
    protected $primaryKey = 'id_aliquota';

    protected $fillable = [
        'id_nazione',
        'aliquota',
    ];

    public function nazione()
    {
        return $this->belongsTo(NazioneModel::class, 'id_nazione', 'id_nazione');
    }
}
