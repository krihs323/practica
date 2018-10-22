<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\DeudorController;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class DeudorTest extends TestCase
{
    use WithoutMiddleware;

    public function testPrioridadRetornaVerdadero(){
      //AAA
      //ARRANGE / ACT / ASSER

      $string = 5000001;
      $deudor = new DeudorController();

      $resultado = $deudor->retornaPrioridad($string);

      $this->assertTrue($resultado, "Esta retornando falso");
    }

    public function testPrioridadRetornaFalso(){
      //AAA
      //ARRANGE / ACT / ASSER

      $string = 4999999;
      $deudor = new DeudorController();

      $resultado = $deudor->retornaPrioridad($string);

      $this->assertFalse($resultado, "Esta retornando verdadero");
    }

    public function testPrioridadRetornaFalso_si_es_5000000(){
      //AAA
      //ARRANGE / ACT / ASSER

      $string = 5000000;
      $deudor = new DeudorController();

      $resultado = $deudor->retornaPrioridad($string);

      $this->assertFalse($resultado, "Esta retornando verdadero");
    }

    public function testPrioridadRetornaFalso_si_ingresa_datos_invalidos(){
      //AAA
      //ARRANGE / ACT / ASSER

      $deudor = new DeudorController();
      $resultado = $deudor->retornaPrioridad("0.1");
      $this->assertFalse($resultado, "Esta retornando verdadero");

      $resultado = $deudor->retornaPrioridad("ABC");
      $this->assertFalse($resultado, "Esta retornando verdadero");

      $resultado = $deudor->retornaPrioridad(1111111111111111111111111111111111111111111111111111111111111111111111);
      $this->assertTrue($resultado, "Esta retornando verdadero");

    }


    public function testRutaCrear(){
      $response = $this->call('GET','/crear');

      $response->assertStatus(200);

    }

    public function testVistaCrear(){
      $response = $this->call('GET','/crear');

      //Assert
      $response->assertViewIs('deudor.crear');

    }



    public function testMetodoGuardarRetorna200DespuesDeCrear(){
      $datos = [
          'nombre_apellido' => 'CRISTIAN BOTINA c',
          'documento' => '1143826302',
          'telefono' => '3124567895',
          'correo' => 'krihs323@gmail.com',
          'saldo' => 6000000,
          'edad' => 18,
        ];
      $response = $this->call('POST', 'guardar',$datos);
      $this->assertContains($response->status(), [200, 302],"Esta generando un error 500 de servidor");

      $sesion = $response->getSession();

      //Ahora la variable sesion tiene un array con los datos guardados en el sesion store, por medio del metodo all, obtengo
      //esos datos en forma de array
      $sesion = $sesion->all();

      //$sesion['message'] debe contener el error controlado que quiero testear del controlador
      $mensaje_esperado = "Deudor creado correctamente";
      $this->assertEquals($mensaje_esperado, $sesion['message'], "Se esperaba el mensaje: ".$mensaje_esperado);

    }

    /*
    * Tests creados para la funcion que comprueba si es mayor de edad o no
    */
    public function testValidarMayorEdad(){
      $deudor = new DeudorController();
      $resultado = $deudor->validarEdad("18");

      $this->assertTrue($resultado, "No retorno true");
    }

    public function testValidarMenorEdad(){
      $deudor = new DeudorController();
      $resultado = $deudor->validarEdad("15");

     $this->assertFalse($resultado, "No retorno false");
    }

    public function testValidarEdadPermiteLetras(){
      $deudor = new DeudorController();
      $resultado = $deudor->validarEdad("a15");

      $this->assertFalse($resultado, "No retorno true");
    }



    /*probar si valida la edad al tratar de crear un deudor menor de 18 años*/
    public function testMetodoGuardarRetornaErrorSiEsMenorDeEdad(){
      $datos = [
          'nombre_apellido' => 'ANDRES',
          'documento' => '1143826302',
          'telefono' => '3124567895',
          'correo' => 'krihs323@gmail.com',
          'saldo' => 6000000,
          'edad' => 17,
        ];
      $response = $this->call('POST', 'guardar',$datos);
      $this->assertContains($response->status(), [200, 302],"Esta generando un error 500 de servidor");

      $sesion = $response->getSession();

      //Ahora la variable sesion tiene un array con los datos guardados en el sesion store, por medio del metodo all, obtengo
      //esos datos en forma de array
      $sesion = $sesion->all();

      //$sesion['message'] debe contener el error controlado que quiero testear del controlador
      $mensaje_esperado = "El deudor es menor de edad";
      $this->assertEquals($mensaje_esperado, $sesion['message-error'], "Se esperaba el mensaje: ".$mensaje_esperado);

    }


}
