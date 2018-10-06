<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;


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

    Deudor::create([
      'nombre_apellido' => $request['nombre_apellido'],
      'documento' => $request['documento'],
      'telefono' => $request['telefono'],
      'correo' => $request['correo'],
      'saldo' => $request['saldo'],
    ]);


    Session::flash('message','Deudor creado correctamente');

    //abort(403, 'Unauthorized action.');
    return redirect('/');
  }



}
