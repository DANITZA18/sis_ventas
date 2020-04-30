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
}
