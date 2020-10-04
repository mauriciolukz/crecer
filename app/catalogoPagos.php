<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class catalogoPagos extends Model
{
    protected $table='catalogopagos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'concepto', 
        'monto', 
        'activo',
        'frecuencia',
        'idMatriz',
        'estatus'
    ];
    protected $guarded=[];
}
