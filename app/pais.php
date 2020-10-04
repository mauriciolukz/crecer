<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pais extends Model
{
    protected $table='pais';
    protected $primaryKey = 'id';
    public $timestamps=false;
    protected $fillable = [ 
        'nombre'
    ];
    protected $guarded=[];
}
