<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use sis_ventas\Descuento;
use sis_ventas\User;

class DescuentoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function lista_descuentos()
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
        Descuento::create([
            'nom' => 'DESCUENTO 1',
            'descuento' => 5,
            'descripcion' => 'DESCUENTO DEL 5%',
        ]);

        $this->get(route('descuentos.index'))
                ->assertStatus(200)
                ->assertSee('DESCUENTO 1')
                ->assertSee(5)
                ->assertSee('DESCUENTO DEL 5%');
    }

    /** @test */
    public function guarda_descuento()
    {
        $sw = false;
        $descuento = Descuento::create([
            'nom' => 'DESCUENTO 1',
            'descuento' => 5,
            'descripcion' => 'DESCUENTO DEL 5%',
        ]);
        if($descuento)
        {
            $sw = true;
        }
        $this->assertTrue($sw);
    }

    /** @test */
    public function actualiza_descuento()
    {
        $sw = false;
        $descuento = Descuento::create([
            'nom' => 'DESCUENTO 1',
            'descuento' => 5,
            'descripcion' => 'DESCUENTO DEL 5%',
        ]);

        $descuento_actualizado = $descuento->update([
            'nom' => 'DESCUENTO 1',
            'descuento' => 3,
            'descripcion' => 'DESCUENTO DEL 3%',
        ]);

        if($descuento_actualizado)
        {
            $sw = true;
        }
        $this->assertTrue($sw);
    }
    
}
