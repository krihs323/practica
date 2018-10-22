@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-body">
                @if(Session::has('message'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{Session::get('message')}}
                  </div>
                @endif
                @if(Session::has('message-error'))
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{Session::get('message-error')}}
                  </div>
                @endif
                    <div class="tab-content">
                         <h1>Crear Deudor</h1>
                      <form method="POST" action="http://localhost/practica/public/guardar" accept-charset="UTF-8" enctype="multipart/form-data">
                        <div class="form-group">
                              <label for="nombre_apellido">Nombre:</label>
                              <input type="text" name="nombre_apellido" class="form-control" required>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        </div>
                        <div class="form-group">
                              <label for="documento">Documento:</label>
                              <input type="text" name="documento" class="form-control">
                        </div>
                        <div class="form-group">
                              <label for="telefono">Teléfono:</label>
                              <input type="text" name="telefono" class="form-control">
                        </div>
                        <div class="form-group">
                              <label for="correo">Correo:</label>
                              <input type="text" name="correo" class="form-control">
                        </div>
                        <div class="form-group">
                              <label for="Saldo">Saldo:</label>
                              <input type="text" name="saldo" class="form-control">
                        </div>
                        <div class="form-group">
                              <label for="edad">Edad:</label>
                              <input type="text" name="edad" class="form-control">
                        </div>
                        <input type="submit" value="Guardar" class="btn btn-primary">
                      </form>
                    </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
