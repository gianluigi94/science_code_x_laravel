<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StagioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stagioni';
    protected $primaryKey = 'id_stagione';

    protected $fillable = [
        'id_serie',
        'descrizione',
        'numero_stagione',
        'numero_episodi',
    ];
    public function serie()
    {
        return $this->belongsTo(SerieModel::class, 'id_serie', 'id_serie');
    }
    public function episodi()
    {
        return $this->hasMany(EpisodioModel::class, 'id_stagione', 'id_stagione');
    }
}
