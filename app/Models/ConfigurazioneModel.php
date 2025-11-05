<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigurazioneModel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'configurazioni';
    protected $primaryKey = 'id_configurazione';

    protected $fillable = [
        'chiave',
        'valore'
    ];

       public static function leggi_valore($chiave)
{
    $config = self::where('chiave', $chiave)->first();
    return $config ? $config->valore : null;
}
}
