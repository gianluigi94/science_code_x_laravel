<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmTraduzioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'film_traduzioni';
    protected $primaryKey = 'id_film_traduzione';

    protected $fillable = [
        'id_film',
        'id_lingua',
        'titolo',
        'sottotitolo',
        'trailer',
        'descrizione',
        'img_locandina',
    ];

    public function film()
    {
        return $this->belongsTo(FilmModel::class, 'id_film', 'id_film');
    }
    public function lingua()
    {
        return $this->belongsTo(LinguaModel::class, 'id_lingua', 'id_lingua');
    }
}
