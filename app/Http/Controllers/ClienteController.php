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