<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nodos extends Model
{
    protected $table='nodos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idIzquierda', 
        'idUser', 
        'idDerecha',
        'idArriba'
    ];
    protected $guarded=[];
}
