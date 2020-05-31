<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use sis_ventas\Cliente;
use sis_ventas\DetalleVenta;
use sis_ventas\Producto;
use sis_ventas\Venta;

class DetalleTest extends TestCase
{
    /**test */
    public function detalleTest()
    {
         $comprueba = Venta::get()->last();
            if($comprueba)
            {
                $nro_fac = $comprueba->nro_factura+1;
            }
            else{
                $nro_fac = '10001';
            }
    
            $venta = new Venta();
            $venta->user_id = 1;
            $venta->cliente_id = 1;
    
            $b_cliente = Cliente::find(1);
    
            $venta->nit = $b_cliente->ci;
            $venta->fecha_venta = '2020-05-31';
            $venta->total = 12.5;
            $venta->total_final=12.5;
            $venta->nro_factura = $nro_fac;
            $codigo_qr = 'QRTEST.png';//NOMBRE DE LA IMAGEN QR
            // generando codigo QRinfo_qr
            $info_qr = 'QRTEST|2020-05-31|48965126';
            $base_64 = base64_encode(\QrCode::format('png')->size(400)->generate($info_qr));
            $imagen_codigo_qr = base64_decode($base_64);
            file_put_contents(public_path().'/imgs/ventas/qr/'.$codigo_qr, $imagen_codigo_qr);
    
            // generando codigo de control
            // crear un array
            $array_codigo = [];
            for($i = 1; $i <= 9; $i++)
            {
                $array_codigo[] = $i;//agregar los números del 1 al 9
            }
            array_push($array_codigo,'A','B','C','D','E','F');//agregar las letras para poder generar un # hexadecimal
            //generar el código
            $codigo_control = '';
            for($i = 1; $i <= 10; $i++)
            {
                $indice = mt_rand(0,14);
                $codigo_control .= $array_codigo[$indice];
                if($i % 2 == 0)
                {
                    $codigo_control .= '-';
                }
            }        
    
            $codigo_control = substr($codigo_control,0,strlen($codigo_control) - 1);//quitar el ultimo guión
    
            $venta->qr = $codigo_qr;
            $venta->codigo_control = $codigo_control;
            $venta->save();
    
    
            // REGISTRAR LOS PRODUCTOS VENDIDOS - DETALLE VENTA
            $productos = [1];
            $precios = [12.5];
            $descuentos = [1];
            $cantidades = [1];
            $totales = [12.5];
            // for($i = 0; $i < count($productos); $i++)
            // {   
            //     $detalle = new DetalleVenta();
            //     $detalle->venta_id = $venta->id;
            //     $detalle->producto_id = $productos[$i];
            //     $detalle->cantidad = $cantidades[$i];
            //     $detalle->costo = $precios[$i];
            //     $detalle->descuento_id = $descuentos[$i];
            //     $detalle->total = $totales[$i];
            //     $detalle->save();
    
            //     $producto = Producto::find($productos[$i]);
            //     // actualizar el stock del producto
            //     $producto->disponible = $producto->disponible - $cantidades[$i];
            //     // actualizar salidas
            //     $producto->salidas = $producto->salidas + $cantidades[$i];
            //     $producto->save();
            // }

        $msj = false;
        if($venta)
        {
            $detalles_venta = $venta->detalles;
            if(count($detalles_venta) > 0)
            {
                $msj = true;
            }
        }
        $this->assertTrue($msj);
    }
}