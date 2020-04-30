<?php

namespace sis_ventas;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nom','costo','disponible','ingresos','salidas',
        'descripcion'
    ];

    public function detalles()
    {
        return $this->hasMany('sis_ventas\DetalleVenta','producto_id','id');
    }

    public function promociones()
    {
        return $this->hasMany('sis_ventas\Promocion','producto_id','id');
    }
}
