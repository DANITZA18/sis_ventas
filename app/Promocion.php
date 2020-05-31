<?php

namespace sis_ventas;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = "promociones";

    protected $fillable = [
        'nom','producto_id','inicio','fin','descuento_id',
        'fecha_inicio','fecha_fin'
    ];
    
    public function producto()
    {
        return $this->belongsTo('sis_ventas\Producto','producto_id','id');
    }

    public function ventas()
    {
        return $this->hasMany('sis_ventas\VentaPromocion','promocion_id','id');
    }

    public function descuento()
    {
        return $this->belongsTo('sis_ventas\Descuento','descuento_id','id');
    }
}
