<?php

namespace sis_ventas;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = [
        'user_id','motivo','estado',
    ];

    public function user(){
        return $this->belongsTo('sis_ventas\User','user_id','id');
    }
}
