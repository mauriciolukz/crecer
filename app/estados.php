<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estados extends Model
{
    protected $table='estados';
    protected $primaryKey = 'id';
    public $timestamps=false;
    protected $fillable = [
        'clave', 
        'idPais', 
        'nombre',
        'abrev',
        'activo'
    ];
    protected $guarded=[];
}
