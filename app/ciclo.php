<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ciclo extends Model
{
    protected $table='ciclo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idUser', 
        'tipo',
        'estatus',
        'idNodo',
        'idMatriz',
        'estatusPago'
    ];
    protected $guarded=[];
}
