<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerieTraduzioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'serie_traduzioni';
    protected $primaryKey = 'id_serie_traduzione';

    protected $fillable = [
        'id_serie',
        'id_lingua',

        // 👇 separazione immagine titolo / testo titolo
        'img_titolo',   // path immagine titolo
        'titolo',       // testo del titolo

        'sottotitolo',
        'trailer',
        'descrizione',
        'img_locandina',
    ];

    public function serie()
    {
        return $this->belongsTo(SerieModel::class, 'id_serie', 'id_serie');
    }

    public function lingua()
    {
        return $this->belongsTo(LinguaModel::class, 'id_lingua', 'id_lingua');
    }
}
