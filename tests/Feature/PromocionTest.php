<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use sis_ventas\Descuento;
use sis_ventas\Producto;
use sis_ventas\Promocion;
use sis_ventas\User;

class PromocionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function lista_promociones()
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
        $descuento = Descuento::create([
            'nom' => 'DESCUENTO 1',
            'descuento' => 5,
            'descripcion' => 'DESCUENTO DEL 5%',
        ]);

        $producto = Producto::create([
            'nom' => 'PRODUCTO 1',
            'costo' => 20.50,
            'disponible' => 0,
            'ingresos' => 0,
            'salidas' => 0,
            'descripcion' => '',
        ]);


        Promocion::create([
            'nom' => 'PROMOCION 1',
            'producto_id' => $producto->id,
            'descuento_id' => $descuento->id,
            'inicio' => 4,
            'fin' => 10,
            'fecha_inicio' => '2020-05-01',
            'fecha_fin' => '2020-05-15',
        ]);

        $this->get(route('promociones.index'))
                ->assertStatus(200)
                ->assertSee('PROMOCION 1')
                ->assertSee($producto->nom)
                ->assertSee('4 a 10 unidades')
                ->assertSee('2020-05-01')
                ->assertSee('2020-05-15');
    }

    /** @test */
    public function guardar_promocion()
    {
        $sw = false;
        $descuento = Descuento::create([
            'nom' => 'DESCUENTO 1',
            'descuento' => 5,
            'descripcion' => 'DESCUENTO DEL 5%',
        ]);

        $producto = Producto::create([
            'nom' => 'PRODUCTO 1',
            'costo' => 20.50,
            'disponible' => 0,
            'ingresos' => 0,
            'salidas' => 0,
            'descripcion' => '',
        ]);

        $promocion = Promocion::create([
            'nom' => 'PROMOCION 1',
            'producto_id' => $producto->id,
            'descuento_id' => $descuento->id,
            'inicio' => 4,
            'fin' => 10,
            'fecha_inicio' => '2020-05-01',
            'fecha_fin' => '2020-05-15',
        ]);

        if($promocion)
        {
            $sw = true;
        }
        
        $this->assertTrue($sw);
    }

    /** @test */
    public function actualiza_promocion()
    {
        $sw = false;
        $descuento = Descuento::create([
            'nom' => 'DESCUENTO 1',
            'descuento' => 5,
            'descripcion' => 'DESCUENTO DEL 5%',
        ]);

        $producto = Producto::create([
            'nom' => 'PRODUCTO 1',
            'costo' => 20.50,
            'disponible' => 0,
            'ingresos' => 0,
            'salidas' => 0,
            'descripcion' => '',
        ]);

        $promocion = Promocion::create([
            'nom' => 'PROMOCION 1',
            'producto_id' => $producto->id,
            'descuento_id' => $descuento->id,
            'inicio' => 4,
            'fin' => 10,
            'fecha_inicio' => '2020-05-01',
            'fecha_fin' => '2020-05-15',
        ]);

        $producto2 = Producto::create([
            'nom' => 'PRODUCTO 2',
            'costo' => 7.50,
            'disponible' => 0,
            'ingresos' => 0,
            'salidas' => 0,
            'descripcion' => '',
        ]);

        $promocion_actualizado = $promocion->update([
            'nom' => 'PROMOCION 1',
            'producto_id' => $producto2->id,
            'descuento_id' => $descuento->id,
            'inicio' => 4,
            'fecha_inicio' => '2020-05-01',
            'fecha_fin' => '2020-05-20',
        ]);

        if($promocion_actualizado)
        {
            $sw = true;
        }
        
        $this->assertTrue($sw);
    }
}
