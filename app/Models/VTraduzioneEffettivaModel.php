<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VTraduzioneEffettivaModel extends Model
{
    use HasFactory;

    protected $table = 'v_traduzioni_effettive';
    protected $primaryKey = 'id_traduzione_effettiva';

    protected $fillable = [
        'chiave',
        'id_lingua',
        'valore',
        'provenienza_custom',
        'updated_at'
    ];
}
