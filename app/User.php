<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'nickname', 
        'email', 
        'password',
        'rol',
        'apellidoPaterno',
        'apellidoMaterno',
        'calle',
        'numero',
        'colonia',
        'codigoPostal',
        'idEstado',
        'idMunicipio',
        'telefono',
        'rfc',
        'curp',
        'padre',
        'estatus',
        'otraMatriz',
        'sigueA',
        'codigo'
    ];
    protected $guarded=[];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
