<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class municipios extends Model
{
    protected $table='municipios';
    protected $primaryKey = 'id';
    public $timestamps=false;
    protected $fillable = [
        'idEstado', 
        'clave', 
        'nombre',
        'activo'
    ];
    protected $guarded=[];
}
