<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use sis_ventas\Producto;
use sis_ventas\User;
use Illuminate\Http\Request;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function lista_Productos()
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
        Producto::create([
            'nom' => 'PRODUCTO 1',
            'costo' => 20.50,
            'disponible' => 0,
            'ingresos' => 0,
            'salidas' => 0,
            'descripcion' => '',
        ]);

        $this->get(route('productos.index'))
                ->assertStatus(200)
                ->assertSee('PRODUCTO 1')
                ->assertSee(20.50)
                ->assertSee(0)
                ->assertSee(0)
                ->assertSee('');
    }

    /** @test */
    public function guardar_producto()
    {
        $sw = false;
        $producto = Producto::create([
            'nom' => 'PRODUCTO 1',
            'costo' => 20.50,
            'disponible' => 0,
            'ingresos' => 0,
            'salidas' => 0,
            'descripcion' => '',
        ]);
        if($producto)
        {
            $sw = true;
        }
        
        $this->assertTrue($sw);
    }

    /** @test */
    public function actualizar_producto()
    {
        $sw = false;
        $producto = Producto::create([
            'nom' => 'PRODUCTO 1',
            'costo' => 20.50,
            'disponible' => 0,
            'ingresos' => 0,
            'salidas' => 0,
            'descripcion' => '',
        ]);
        $producto_actualizado = $producto->update([
            'nom' => 'PRODUCTO 20',
            'costo' => 5.50,
            'disponible' => 0,
            'ingresos' => 0,
            'salidas' => 0,
            'descripcion' => 'Descripcion del producto',
        ]);
        
        if($producto_actualizado)
        {
            $sw = true;
        }
        
        $this->assertTrue($sw);
    }

    /** @test */
    public function registraIngresoProducto()
    {
        $producto = Producto::create([
            'nom' => 'PRODUCTO 1',
            'costo' => 20.50,
            'disponible' => 0,
            'ingresos' => 0,
            'salidas' => 0,
            'descripcion' => '',
        ]);

        $request = new Request([
            'cantidad' => 7,
        ]);

        $producto->ingresos = $request->cantidad + $producto->ingresos;
        $producto->disponible = $request->cantidad + $producto->disponible;
        $sw = false;
        if($producto->save())
        {
            $sw=true;
        }
        $this->assertTrue($sw);
        $this->assertEquals(7,$producto->disponible);
    }
}
