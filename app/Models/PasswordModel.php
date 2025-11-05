<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PasswordModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'password';
    protected $primaryKey = 'id_password';

    protected $fillable = [
        'id_contatto',
        'password',
        'sale',
        'blocco_password'
    ];

    public function contatto()
    {
        return $this->belongsTo(ContattoModel::class, 'id_contatto', 'id_contatto');
    }

     public static function password_attuale($id_contatto)
    {
        $record = PasswordModel::where('id_contatto', $id_contatto)->orderBy('id_password', 'desc')->firstOrFail();
        return $record;
    }
}
