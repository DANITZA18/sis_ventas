<?php

namespace sis_ventas\Http\Controllers;

use Illuminate\Http\Request;
use sis_ventas\Cliente;
use sis_ventas\Http\Requests\ClienteStoreRequest;
use sis_ventas\Http\Requests\ClienteUpdateRequest;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            $clientes = Cliente::all();
            return view('clientes.index',compact('clientes'));
        }
        abort(401, 'Acceso no autorizado');
    }
    public function create(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            return view('clientes.create');
        }
        abort(401, 'Acceso no autorizado');
    }

    public function store(ClienteStoreRequest $request)
    {
        $cliente = Cliente::create(array_map('mb_strtoupper',$request->all()));
        $cliente->estado = 1;
        $cliente->save();
        return redirect()->route('clientes.index')->with('bien','Cliente registrado con éxito');
    }

    public function edit(Cliente $cliente, Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR' || $request->user()->tipo == 'EMPLEADO')
        {
            return view('clientes.edit',compact('cliente'));
        }
        abort(401, 'Acceso no autorizado');
    }
