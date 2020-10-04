<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    protected $table='pagoscrecer';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idUser', 
        'idCatalogoPagos', 
        'comprobante',
        'fechaComprobante',
        'estatus'
    ];
    protected $guarded=[];
}
