<?php

namespace sis_ventas\Http\Controllers;

use Illuminate\Http\Request;

use sis_ventas\Medida;
class MedidaController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->tipo == 'NUTRICIONISTA')
        {
            $medidas = Medida::all();
            return view('medidas.index',compact('medidas'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function create(Request $request)
    {
        if($request->user()->tipo == 'NUTRICIONISTA')
        {
            return view('medidas.create');
        }
        abort(401, 'Acceso no autorizado');
    }

    public function store(Request $request)
    {
        Medida::create($request->all());
        return redirect()->route('medidas.index')->with('bien','Medida registrada con éxito');
    }

    public function edit(Medida $medida, Request $request)
    {
        if($request->user()->tipo == 'NUTRICIONISTA')
        {
            return view('medidas.edit',compact('medida'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function update(Request $request, Medida $medida)
    {
        $medida->update($request->all());
        return redirect()->route('medidas.index')->with('bien','Medida modificada con éxito');
    }

    public function show(Medida $medida)
    {

    }

    public function destroy(Medida $medida)
    {
        $medida->delete();
        return redirect()->route('medidas.index')->with('bien','Registro elimnado');
    }
}
