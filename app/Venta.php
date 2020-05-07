<?php

namespace sis_ventas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'empleado_id','cliente','nit','fecha_venta','nro_factura','total','total_final','qr',
        'codigo_control'
    ];

    public function user()
    {
        return $this->belongsTo('sis_ventas\User','user_id','id');
    }

    public function detalles()
    {
        return $this->hasMany('sis_ventas\DetalleVenta','venta_id','id');
    }

    public function promociones()
    {
        return $this->hasMany('sis_ventas\VentaPromocion','venta_id','id');
    }

    public function cliente()
    {
        return $this->belongsTo('sis_ventas\Cliente','cliente_id','id');
    }
}
