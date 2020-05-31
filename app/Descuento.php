<?php

namespace sis_ventas;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $fillable = [
        'nom','descuento','descripcion'
    ];

    public function detalles()
    {
        return $this->hasMany('sis_ventas\DetalleVenta','descuento_id','id');
    }

    public function promociones()
    {
        return $this->hasMany('sis_ventas\Promocion','descuento_id','id');
    }
}
