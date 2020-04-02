<?php

namespace sis_ventas;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombre','paterno','materno','ci',
        'ci_exp','dir','cel','fono',
        'foto','correo','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('sis_ventas\User','user_id','id');
    }
}
