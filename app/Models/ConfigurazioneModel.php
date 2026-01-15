<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigurazioneModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'configurazioni'; //Nome della tabella associata al modello
    protected $primaryKey = 'id_configurazione'; //Identificativo del record

    //Elenco dei campi che possono essere salvati nel modello
    protected $fillable = [
        'chiave',
        'valore'
    ];

    /**
     * Legge il valore di configurazione associato alla chiave.
     *
     * @param string $chiave
     * @return string|null
     */
    public static function leggi_valore($chiave)
    {
        $config = self::where('chiave', $chiave)->first();
        return $config ? $config->valore : null;
    }
}
