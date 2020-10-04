<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userMatriz extends Model
{
    protected $table='usermatriz';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idUser', 
        'idMatriz',
        'estatus',
    ];
    protected $guarded=[];
}
