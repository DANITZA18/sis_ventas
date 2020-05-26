<?php

namespace sis_ventas\Http\Controllers;

use Illuminate\Http\Request;
use sis_ventas\Descuento;
use sis_ventas\Producto;
use sis_ventas\Promocion;
use sis_ventas\VentaPromocion;

class PromocionController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR')
        {
            $promociones = Promocion::all();
            return view('promociones.index',compact('promociones'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function create(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR')
        {
            $productos = Producto::all();
            $array_productos[''] = 'Seleccione';
            foreach($productos as $producto)
            {
                $array_productos[$producto->id] = $producto->nom;
            }

            $descuentos = Descuento::all();
            $array_descuentos[''] = 'Seleccione';
            foreach($descuentos as $descuento)
            {
                $array_descuentos[$descuento->id] = $descuento->nom.' - '.$descuento->descuento.' %';
            }
            return view('promociones.create',compact('array_productos','array_descuentos'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function store(Request $request)
    {
        $promocion = Promocion::create(array_map('mb_strtoupper',$request->all()));
        if($request->fin == null)
        {
            $promocion->fin = null;
            $promocion->save();
        }
        return redirect()->route('promociones.index')->with('bien','Promoción registrado con éxito');
    }

    public function edit(Promocion $promocion, Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR')
        {
            $productos = Producto::all();
            $array_productos[''] = 'Seleccione';
            foreach($productos as $producto)
            {
                $array_productos[$producto->id] = $producto->nom;
            }

            $descuentos = Descuento::all();
            $array_descuentos[''] = 'Seleccione';
            foreach($descuentos as $descuento)
            {
                $array_descuentos[$descuento->id] = $descuento->nom.' - '.$descuento->descuento.' %';
            }
            return view('promociones.edit',compact('promocion','array_productos','array_descuentos'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function update(Request $request, Promocion $promocion)
    {
        $promocion->update(array_map('mb_strtoupper',$request->all()));
        if($request->fin == null)
        {
            $promocion->fin = null;
            $promocion->save();
        }
        return redirect()->route('promociones.index')->with('bien','Promoción modificado con éxito');
    }

    public function show(Promocion $promocion)
    {

    }

    public function destroy(Promocion $promocion)
    {
        $comprueba = VentaPromocion::where('promocion_id',$promocion->id)->get()->first();
        if($comprueba)
        {
            return redirect()->route('promociones.index')->with('uso','No se puede eliminar el registro porque esta siendo utilizado');
        }
        else{
            $promocion->delete();
            return redirect()->route('promociones.index')->with('bien','Registro elimnado');
        }
    }
}
