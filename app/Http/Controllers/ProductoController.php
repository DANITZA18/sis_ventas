<?php

namespace sis_ventas\Http\Controllers;

use Illuminate\Http\Request;
use sis_ventas\Descuento;
use sis_ventas\DetalleVenta;
use sis_ventas\Producto;
use sis_ventas\Promocion;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            $productos = Producto::all();
            return view('productos.index',compact('productos'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function create(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            return view('productos.create');
        }
        abort(401, 'Acceso no autorizado');
    }

    public function store(Request $request)
    {
        $producto = Producto::create(array_map('mb_strtoupper',$request->all()));
        $producto->disponible = $request->ingresos;
        $producto->salidas = 0;
        $producto->save();
        return redirect()->route('productos.index')->with('bien','Producto registrado con éxito');
    }

    public function edit(Producto $producto, Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            return view('productos.edit',compact('producto'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function update(Request $request, Producto $producto)
    {
        $comprueba = DetalleVenta::where('producto_id',$producto->id)->get();
        if(count($comprueba) > 0)
        {
            $producto->update(array_map('mb_strtoupper',$request->except('ingresos')));
            $producto->save();
            return redirect()->route('productos.index')->with('noActualizable','El producto que desea actualizar ya tiene ventas realizadas por lo que los cambios solo tendran efecto sobre el nombre y descripción.')
            ->with('bien','Producto modificado con éxito');
        }
        else{
            $producto->update(array_map('mb_strtoupper',$request->all()));
            $producto->disponible = $request->ingresos;
            $producto->save();
            return redirect()->route('productos.index')->with('bien','Producto modificado con éxito');
        }
    }

    public function show(Producto $producto)
    {

    }

    public function destroy(Producto $producto)
    {
        $comprueba = DetalleVenta::where('producto_id',$producto->id)->get()->first();
        if($comprueba)
        {
            return redirect()->route('productos.index')->with('uso','No se puede eliminar el registro porque esta siendo utilizado');
        }
        else{
            $producto->delete();
            return redirect()->route('productos.index')->with('bien','Registro elimnado');
        }
    }

    public function ingreso(Request $request, Producto $producto)
    {
        $producto->ingresos = $request->cantidad + $producto->ingresos;
        $producto->disponible = $request->cantidad + $producto->disponible;
        $producto->save();
        return redirect()->route('productos.index')->with('bienIngreso','Ingreso del producto '.$producto->nom.' registrado con éxito');
    }

    public function infoProducto(Producto $producto,Request $request)
    {
        // COMPROBAR SI EL PRODUCTO TIENE ALGUNA PROMOCIÓN VIGENTE
        $promocion = Promocion::where('producto_id',$producto->id)
                                ->where('fecha_fin','>=',date('Y-m-d'))
                                ->get()
                                ->first();
        $promocion_id= '';

        $select_descuentos = '<select class="form-control">';
        $descuentos = Descuento::all();
        if(count($descuentos) > 0)
        {
            foreach($descuentos as $descuento)
            {
                // si existe una promocion y ademas cumple la cantidad que se indica para seleccionar el descuento
                if($promocion && $request->cantidad >= $promocion->inicio)
                {
                    if($promocion->fin == null)
                    {
                        if($descuento->id == $promocion->descuento_id)
                        {
                            $select_descuentos.= '<option value="'.$descuento->id.'" selected>'.number_format($descuento->descuento,2).'</option>';
                        }
                        else{
                            $select_descuentos.= '<option value="'.$descuento->id.'">'.number_format($descuento->descuento,2).'</option>';
                        }
                        $promocion_id = $promocion->id;
                    }
                    else{
                        if($request->cantidad <= $promocion->fin)
                        {
                            if($descuento->id == $promocion->descuento_id)
                            {
                                $select_descuentos.= '<option value="'.$descuento->id.'" selected>'.number_format($descuento->descuento,2).'</option>';
                            }
                            else{
                                $select_descuentos.= '<option value="'.$descuento->id.'">'.number_format($descuento->descuento,2).'</option>';
                            }
                            $promocion_id = $promocion->id;
                        }
                        else{
                            if($descuento->descuento == 0.00)
                            {
                                $select_descuentos.= '<option value="'.$descuento->id.'" selected>'.number_format($descuento->descuento,2).'</option>';
                            }
                            else{
                                $select_descuentos.= '<option value="'.$descuento->id.'">'.number_format($descuento->descuento,2).'</option>';
                            }
                        }
                    }
                }
                else{
                    if($descuento->descuento == 0.00)
                    {
                        $select_descuentos.= '<option value="'.$descuento->id.'" selected>'.number_format($descuento->descuento,2).'</option>';
                    }
                    else{
                        $select_descuentos.= '<option value="'.$descuento->id.'">'.number_format($descuento->descuento,2).'</option>';
                    }
                }

            }
        }
        else{
            $select_descuentos.= '<option value="0" selected disabled>0.00</option>';
        }

        $select_descuentos.='</select>';

        return response()->JSON([
            'nombre' => $producto->nom,
            'costo' => $producto->costo,
            'select_descuentos' => $select_descuentos,
            'promocion_id' => $promocion_id
        ]);
    }

    public function masVendidos(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            return view('productos.masVendidos');
        }
        abort(401, 'Acceso no autorizado');
    }

    public function estadisticas(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $productos = Producto::all();
        $datos = [];
        $categorias = [];
        foreach($productos as $producto)
        {
            $detalles = DetalleVenta::where('producto_id',$producto->id)->get(); 
            if($filtro != 1)
            {
                $detalles = DetalleVenta::select('detalle_ventas.*')
                                        ->join('ventas','ventas.id','=','detalle_ventas.venta_id')
                                        ->where('producto_id',$producto->id)
                                        ->whereBetween('ventas.fecha_venta',[$fecha_ini,$fecha_fin])
                                        ->get(); 
            }
            $cantidad = 0;
            if(count($detalles) > 0)
            {
                $cantidad = DetalleVenta::where('producto_id', $producto->id)->get()->sum('cantidad');
              
            }
            $datos[] = [$producto->nom,(int)$cantidad];
            $categorias[] = $producto->nom;
        }
        return response()->JSON([
            'datos'=>$datos,
        ]);
    }
}
