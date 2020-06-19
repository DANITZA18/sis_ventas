<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use sis_ventas\Cliente;

class ClientesTest extends TestCase
{
    /** @test*/
    public function registroClienteTest()
    {
        $request = new Request();
        $request = [
        //al comentar el 'nombre' nos mostrara error por que valida la linea 32.
        //Si asignamos un nombre de prueba funcionara de esta forma se cumple la linea 32.
            // 'nombre' => 'Juan Perez',
            'ci' => '6845641',
            'ci_exp' => 'LP',
            'cel' => '65487974',
        ];
        $cliente = Cliente::create(array_map('mb_strtoupper',$request));
       //nombre de prueba
        $cliente->nombre = 'Luciana Fuster';
        $cliente->estado = 1;
        $cliente->save();

        $sw = false;
        // if($cliente)
        //verificar datos del formulario (nombre y el CI)
        {
            if($cliente->nombre != null && is_numeric ($cliente->ci))
            {
                $sw = true;
            }
        }
        // if($cliente->nombre != null)
        // {
        //     $sw = true;
        // }

    $this->assertTrue($sw);
    }
}
