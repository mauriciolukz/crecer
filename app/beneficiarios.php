<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class beneficiarios extends Model
{
    protected $table='beneficiarios';
    protected $primaryKey = 'id';
    public $timestamps=false;
    protected $fillable = [
        'nombre', 
        'email', 
        'celular',
        'idUser',
        'parentesco',
        'estatus'
    ];
    protected $guarded=[];
}
