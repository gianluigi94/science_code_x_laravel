<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VnovitaModel extends Model
{
    protected $table = 'vista_novita';

    // È una view
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'descrizione',
        'titolo',
        'img_titolo',
        'sottotitolo',
        'trailer',
        'lingua',
    ];
}
