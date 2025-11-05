<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaSerieModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categoria_serie';
    protected $primaryKey = 'id_categoria_serie';

    protected $fillable = [
        'id_categoria',
        'id_serie',
    ];
}
