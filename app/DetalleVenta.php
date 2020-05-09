<?php

namespace sis_ventas;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $fillable = [
        'producto_id','cantidad','costo','descuento_id','total'
    ];
    

    public function producto()
    {
        return $this->belongsTo('sis_ventas\Producto','producto_id','id');
    }

    public function descuento()
    {
        return $this->belongsTo('sis_ventas\Descuento','descuento_id','id');
    }

    public function venta()
    {
        return $this->belongsTo('sis_ventas\Venta','venta_id','id');
    }
}
