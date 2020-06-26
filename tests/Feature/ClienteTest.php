<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use sis_ventas\Cliente;
use sis_ventas\User;

class ClienteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function lista_clientes()
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
        Cliente::create([
            'nombre' => 'JUAN PERES',
            'ci' => '45678912',
            'ci_exp' => 'LP',
            'cel' => '78945612',
            'estado' => 1,
        ]);

        $this->get(route('clientes.index'))
                ->assertStatus(200)
                ->assertSee('JUAN PERES X')
                ->assertSee('45678912 LP')
                ->assertSee('78945612')
                ->assertSee('ACTIVO');
    }

    /** @test */
    public function guarda_cliente()
    {
        $sw = false;
        $cliente = Cliente::create([
            'nombre' => 'JUAN PERES',
            'ci' => '45678912',
            'ci_exp' => 'LP',
            'cel' => '78945612',
            'estado' => 1,
        ]);
        if($cliente)
        {
            $sw = true;
        }
        $this->assertTrue($sw);
    }

    /** @test */
    public function actualiza_cliente()
    {
        $sw = false;
        $cliente = Cliente::create([
            'nombre' => 'JUAN PERES',
            'ci' => '45678912',
            'ci_exp' => 'LP',
            'cel' => '78945612',
            'estado' => 1,
        ]);

        $cliente_actualizado = $cliente->update([
            'nombre' => 'JUAN PERES',
            'ci' => '45678912',
            'ci_exp' => 'CB',
            'cel' => '66688877',
            'estado' => 1,
        ]);

        if($cliente_actualizado)
        {
            $sw = true;
        }
        $this->assertTrue($sw);
    }
}
