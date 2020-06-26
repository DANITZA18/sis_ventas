<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use sis_ventas\User;
use sis_ventas\Cliente;
use sis_ventas\DetalleVenta;
use sis_ventas\Producto;
use sis_ventas\Empleado;
use sis_ventas\Venta;
use Illuminate\Http\Request;
use sis_ventas\Descuento;
use Illuminate\Support\Facades\Hash;
class DetalleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function detalleTest()
    {
        $this->withExceptionHandling();

        $user = new User([
            'id' => 1,
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'foto' => 'user_default.png',
            'tipo' => 'ADMINISTRADOR',
            'estado' => 1
        ]);
        $this->actingAs($user);//ASIGNAR EL ACCESO

        $usuario = User::create([
            'name' => 'JPERES',
            'password' => Hash::make('12345678'),
            'foto' => 'user_default.png',
            'tipo' => 'EMPLEADO',
            'estado' => 1
        ]);
        $empleado = Empleado::create([
            'nombre' => 'JUAN',
            'paterno' => 'PERES',
            'materno' => 'CAMACHO',
            'ci' => '12345678',
            'ci_exp' => 'LP',
            'dir' => 'ZONA LOS OLIVOS CALLE 3 #32',
            'cel' => '78945612',
            'fono' => '22345678',
            'foto' => 'JUAN.jpeg',
            'correo' => 'juan@gmail.com',
            'rol' => 'ALMACENERO',
            'user_id' => $usuario->id,
        ]);

        // CREAR UN CLIENTE
        $cliente = Cliente::create([
            'nombre' => 'JUAN PERES',
            'ci' => '45678912',
            'ci_exp' => 'LP',
            'cel' => '78945612',
            'estado' => 1,
        ]);

        // CREAR PRODUCTOS
        $producto1 = Producto::create([
            'nom' => 'PRODUCTO 1',
            'costo' => 7.00,
            'disponible' => 3,
            'ingresos' => 3,
            'salidas' => 0,
            'descripcion' => '',
        ]);
        $producto2 = Producto::create([
            'nom' => 'PRODUCTO 2',
            'costo' => 5.50,
            'disponible' => 10,
            'ingresos' => 10,
            'salidas' => 0,
            'descripcion' => '',
        ]);

        // DESCUENTOS
        $descuento = Descuento::create([
            'nom' => 'SIN DESCUENTO',
            'descuento' => 0,
            'descripcion' => 'DESCUENTO DEL 0%',
        ]);

        $request = new Request([
            '_token' => csrf_token(),
            'cliente_id' => $cliente->id,
            'fecha_venta' => '2020-06-01',
            'total' => '12.50',
            'cantidad_total' => 2,
            'total_final' => '12.50',
            'productos' => [$producto1->id, $producto2->id],
            'precios' => [7,5.5],
            'descuentos' => [$descuento->id,$descuento->id],
            'cantidades' => [1,1],
            'totales' => [7,5.5],
        ]);

        $sw = false;

        $comprueba = Venta::get()->last();
        if($comprueba)
        {
            $nro_fac = $comprueba->nro_factura+1;
        }
        else{
            $nro_fac = '10001';
        }

        $venta = new Venta();
        $venta->user_id = $usuario->id;
        $venta->cliente_id = $request->cliente_id;

        $b_cliente = Cliente::find($request->cliente_id);

        $venta->nit = $b_cliente->ci;
        $venta->fecha_venta = $request->fecha_venta;
        $venta->total = $request->total;
        $venta->total_final=$request->total_final;
        $venta->nro_factura = $nro_fac;
        $codigo_qr = 'QR_'.$venta->nit.time().'.png';//NOMBRE DE LA IMAGEN QR
        // generando codigo QRinfo_qr
        $info_qr = $venta->nit.'|'.$venta->fecha_venta.'|'.$venta->codigo_control.'|'.$venta->total_final;
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
        $productos = $request->productos;
        $precios = $request->precios;
        $descuentos = $request->descuentos;
        $cantidades = $request->cantidades;
        $totales = $request->totales;
        for($i = 0; $i < count($productos); $i++)
        {   
            $detalle = new DetalleVenta();
            $detalle->venta_id = $venta->id;
            $detalle->producto_id = $productos[$i];
            $detalle->cantidad = $cantidades[$i];
            $detalle->costo = $precios[$i];
            $detalle->descuento_id = $descuentos[$i];
            $detalle->total = $totales[$i];
            $detalle->save();

            $producto = Producto::find($productos[$i]);
            // actualizar el stock del producto
            $producto->disponible = $producto->disponible - $cantidades[$i];
            // actualizar salidas
            $producto->salidas = $producto->salidas + $cantidades[$i];
            $producto->save();
        }

        if($venta && count($venta->detalles) > 0)
        {
            $sw = true;
        }

        $this->assertTrue($sw);
    }
}