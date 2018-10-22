<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Deudor;


class DeudorController extends Controller
{
  public function retornaPrioridad($valor){

    if ($valor>5000000) {
      return true;
    } else {
      return false;
    }

  }

  public function crearDeudor(){
    return view('deudor.crear');
  }

  public function guardarDeudor(Request $request){

    if($this->validarEdad($request['edad'])==false){
      Session::flash('message-error','El deudor es menor de edad');
      return redirect()->to('crear');
    }


    Deudor::create([
      'nombre_apellido' => $request['nombre_apellido'],
      'documento' => $request['documento'],
      'telefono' => $request['telefono'],
      'correo' => $request['correo'],
      'saldo' => $request['saldo'],
      'edad' => $request['edad'],
    ]);


    Session::flash('message','Deudor creado correctamente');
    return redirect('crear');
  }

  public function validarEdad($edad){

    if ($edad>=18) {
      return true;
    }else{
      return false;
    }
  }



}
