<?php

namespace sis_ventas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use sis_ventas\Empleado;
use sis_ventas\User;
class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR')
        {
            $empleados = Empleado::select('users.name as usuario','users.tipo','empleados.*')
                            ->join('users','users.id','=','empleados.user_id')
                            ->where('users.estado',1)
                            ->orderBy('empleados.nombre','asc')
                            ->get();
            return view('empleados.index',compact('empleados'));
        }
        abort(401, 'Acceso no autorizado');
    }

    public function create(Request $request)
    {
        if($request->user()->tipo == 'ADMINISTRADOR')
        {
            return view('empleados.create');
        }
        abort(401, 'Acceso no autorizado');
    }

    public function store(Request $request)
    {
        $empleadoC = new EmpleadoController();
        $nombre_usuario = $empleadoC->nombreUsuario($request->nombre,$request->paterno);
        $comprueba = User::where('name',$nombre_usuario)->get()->first();
        $cont = 1;
        while($comprueba)
        {
            $nombre_usuario = $nombre_usuario.$cont;
            $comprueba = User::where('name',$nombre_usuario)->get()->first();
            $cont++;
        }

        $nuevo_usuario = new User();
        $nuevo_usuario->name = $nombre_usuario;
        $nuevo_usuario->password = Hash::make($request->ci);
        $nuevo_usuario->tipo = $request->tipo;
        $nuevo_usuario->foto = "user_default.png";
        $nuevo_usuario->estado = 1;
        $nuevo_usuario->save();

        // CREANDO LOS DATOS DEL USUARIO
        $datos_empleado = new Empleado(array_map('mb_strtoupper',$request->except('foto','correo')));
        $datos_empleado->correo = $request->correo;
        $nom_foto = 'user_default.png';
        if($request->hasFile('foto'))
        {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = ".".$file_foto->getClientOriginalExtension();
            $nom_foto = $nombre_usuario.str_replace(' ','_',$datos_empleado->nombre).time().$extension;
            $file_foto->move(public_path()."/imgs/empleado/",$nom_foto);
            //completar los campos foto y fecha registro del empleadol
        }
        $datos_empleado->foto = $nom_foto;
        $nuevo_usuario->empleado()->save($datos_empleado);

        return redirect()->route('users.index')->with('bien','Empleado registrado con éxito');
    }

    public function nombreUsuario($nom, $apep)
    {
        //determinando el nombre de usuario inicial del 1er_nombre+apep+tipoUser
        $nombre_user = substr(mb_strtoupper($nom),0,1);//inicial 1er_nombre
        $nombre_user .= mb_strtoupper($apep);

        return $nombre_user;
    }
}
