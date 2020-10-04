<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagosUsuarios extends Model
{
    protected $table='pagos_usuarios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 
        'ciclo_id',
        'matriz_id',
        'comunidad',
        'comisiones',
        'estatus',
        
    ];
    protected $guarded=[];
}
