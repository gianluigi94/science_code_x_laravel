<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TraduzioneCustomModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'traduzioni_custom';
    protected $primaryKey = 'id_traduzione_custom';

    protected $fillable = [
        'chiave',
        'id_lingua',
        'valore'
    ];


    public function lingua()
    {
        return $this->belongsTo(LinguaModel::class, 'id_lingua', 'id_lingua');
    }
}
