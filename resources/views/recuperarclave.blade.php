@extends('app')

@section('content')

<form action="{{ url('verificarpaciente') }}" method="post">
  <div class="row">
      <div class=" col-md-6 col-md-offset-3"  >
        <div class="panel panel-default panel-info">
          <div class="panel-heading">Recuperar Acceso</div>
          <div class="panel-body">
            <p class="text-info">Ingrese los datos a continuación en caso de no recordar su contraseña.</p>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="form-group has-success">
                    <label class="control-label" for="dni">DNI</label>
                    <input type="number" class="form-control input-error" id="dni" name="documento" min=0 required>

                    <label class="control-label" for="fecha_nacimiento">Fecha Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento" placeholder="Fecha de Nacimiento" required>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <a href="{{ route('login') }}" type="button" name="button" class="btn btn-primary">Cancelar</a>
                <button type="submit" name="button" class="btn btn-success pull-right">Verificar</button>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  {{ csrf_field() }}
</form>

@endsection
