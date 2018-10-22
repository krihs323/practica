<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deudor extends Model
{
  protected $fillable = [
    'nombre_apellido', 'documento', 'telefono', 'correo', 'saldo', 'edad',
  ];
}
