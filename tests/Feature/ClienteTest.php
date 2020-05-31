<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use sis_ventas\Cliente;

class ClienteTest extends TestCase
{
    /** @test */
    public function registroClienteTest()
    {
        $request = new Request();
         $request = [
        //al comentar el 'nombre' nos mostrara error por que valida la linea 32.
        //Si asignamos un nombre de prueba funcionara de esta forma se cumple la linea 32.
            'nombre' => 'Juan Perez',
            'ci' => '6845641',
            'ci_ex' => 'LP',
            'cel' => '65487974',
        ];
        $cliente = new cliente(array_map('mb_strtoupper',$datos));
       //nombre de prueba
        // $cliente->nombre = 'Luciana Fuster'
        $cliente->estado = 1;
        $cliente->save();

        $sw = false;
        if($cliente->nombre != null)
        {
            $sw = true;
        }

    $this->assertTrue($sw);
    }
}
