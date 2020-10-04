<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class saldos extends Model
{
    protected $table='saldos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idUser', 
        'monto',
    ];
    protected $guarded=[];
}
