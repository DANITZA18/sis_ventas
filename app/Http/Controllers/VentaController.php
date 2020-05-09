<?php

namespace sis_ventas\Http\Controllers;

use Illuminate\Http\Request;
use sis_ventas\DetalleVenta;
use sis_ventas\Producto;
use sis_ventas\Venta;
use sis_ventas\VentaPromocion;
use Barryvdh\DomPDF\Facade as PDF;
use sis_ventas\Cliente;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            $ventas = Venta::all();
            return view('ventas.index',compact('ventas'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function create(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            $productos = Producto::all();
            $clientes = Cliente::where('estado',1)->get();
            $array_clientes[''] = 'Seleccione' ;
            foreach($clientes as $cliente)
            {
                $array_clientes[$cliente->id] = $cliente->nombre;
            }
            return view('ventas.create',compact('productos','array_clientes'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function store(Request $request)
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
        $venta->user_id = $request->user()->id;
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

        // REGISTRAR LAS PROMOCIONES
        if(isset($request->promociones))
        {
            $promociones = $request->promociones;
            for($i = 0; $i < count($promociones); $i++)
            {
                $promocion = new VentaPromocion();
                $promocion->venta_id = $venta->id;
                $promocion->promocion_id = $promociones[$i];
                $promocion->save();
            }
        }

        return response()->JSON([
            'msj' => true,
            'ruta' => route('ventas.show',$venta->id)
        ]);
    }

    public function edit(Venta $venta, Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            return view('ventas.edit',compact('venta'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function update(Request $request, Venta $venta)
    {
        $venta->update(array_map('mb_strtoupper',$request->all()));
        return redirect()->route('ventas.index')->with('bien','Venta modificada con éxito');
    }

    public function show(Venta $venta)
    {
        return view('ventas.show',compact('venta'));
    }

    public function destroy(Venta $venta)
    {
        $comprueba = DetalleVenta::where('venta_id',$venta->id)->get()->first();
        if($comprueba)
        {
            return redirect()->route('ventas.index')->with('uso','No se puede eliminar el registro porque esta siendo utilizado');
        }
        else{
            $venta->delete();
            return redirect()->route('ventas.index')->with('bien','Registro elimnado');
        }
    }
    
    public function factura(Venta $venta)
    {
        $date = date('d/m/Y');
        $pdf = PDF::loadView('ventas.pdf',compact('venta','date'));
        return $pdf->stream('Factura.pdf');
    }
}
