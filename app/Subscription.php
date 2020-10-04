<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table='subscriptions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user', 
        'amount',
        'id_matriz',
        
    ];
    protected $guarded=[];
}
