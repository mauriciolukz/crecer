<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class infoBancos extends Model
{
    protected $table='infbancos';
    protected $primaryKey = 'id';
    public $timestamps=false;
    protected $fillable = [
        'nombre', 
        'noCuenta', 
        'tarjeta',
        'clabe',
        'idUser'
    ];
    protected $guarded=[];
}
