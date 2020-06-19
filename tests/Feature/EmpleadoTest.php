<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use sis_ventas\Empleado;
use sis_ventas\User;

use Illuminate\Support\Facades\Auth;

class EmpleadoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function lista_empleados()
    {
        $this->withExceptionHandling();
        // OBTENER ACCESO CON UN USUARIO
        $user = new User([
            'id' => 1,
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'foto' => 'user_default.png',
            'tipo' => 'ADMINISTRADOR',
            'estado' => 1
        ]);
        $this->actingAs($user);//ASIGNAR EL ACCESO


        // PRUEBA
        $usuario = User::create([
            'name' => 'JPERES',
            'password' => Hash::make('12345678'),
            'foto' => 'user_default.png',
            'tipo' => 'EMPLEADO',
            'estado' => 1
        ]);

        Empleado::create([
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

        $this->get(route('users.index'))
                ->assertStatus(200)
                ->assertSee('ALMACENERO')
                ->assertSee('JUAN')
                ->assertSee('PERES')
                ->assertSee('CAMACHO')
                ->assertSee('12345678')
                ->assertSee('LP')
                ->assertSee('78945612');
    }

    /**@test */
    public function guarda_empleado()
    {
        $sw = false;
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
        if($empleado)
        {
            $sw =true;
        }
        $this->asserTrue($sw);
    }

    /**@test */
    public function actualiza_empleado()
    {
        $sw = false;
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

        $empleado_actualizado = $empleado->update([
            'nombre' => 'JUAN',
            'paterno' => 'PERES',
            'materno' => 'CAMACHO',
            'ci' => '6864123',
            'ci_exp' => 'LP',
            'dir' => 'ZONA LOS OLIVOS CALLE 5 #222',
            'cel' => '78945612',
            'foto' => 'JUAN.jpeg',
            'correo' => 'juan@gmail.com',
            'rol' => 'VENDEDOR',
            'user_id' => $usuario->id,
        ]);

        if($empleado_actualizado)
        {
            $sw =true;
        }
        $this->asserTrue($sw);
    }
}
