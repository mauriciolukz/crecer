<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class matriz extends Model
{
    protected $table='matriz';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idInicial', 
        'nombre', 
        'descripcion',
        'estatus'
    ];
    protected $guarded=[];
}
