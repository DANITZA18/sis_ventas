<?php

namespace sis_ventas;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre','ci','ci_exp','cel',
    ];

    public function ventas()
    {
        return $this->hasMany('sis_ventas\Venta','cliente_id','id');
    }
}
