<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'registi';
    protected $primaryKey = 'id_regista';

    protected $fillable = [
        'nome'
    ];

    public function film()
    {
        return $this->hasMany(FilmModel::class, 'id_regista', 'id_regista');
    }
    public function serie()
    {
        return $this->hasMany(SerieModel::class, 'id_regista', 'id_regista');
    }
}
