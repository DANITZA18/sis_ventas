<?php

namespace sis_ventas;

use Illuminate\Database\Eloquent\Model;

class VentaPromocion extends Model
{
    protected $table="venta_promociones"; 
    
    protected $fillable = [
        'venta_id','promocion_id'
    ];

    public function ventas()
    {
        return $this->belongsTo('sis_ventas\Venta','venta_id','id');
    }

    public function promocion()
    {
        return $this->belongsTo('sis_ventas\Promocion','promocion_id','id');
    }
}
