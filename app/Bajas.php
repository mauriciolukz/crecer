<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bajas extends Model
{
    protected $table      = 'bajas';
    protected $primaryKey = 'id';
    protected $fillable   = ['idUser', 'motivo'];
    protected $guarded    = [];
}
