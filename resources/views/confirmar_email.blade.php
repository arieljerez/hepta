@extends('app')
@section('content')
<div class="col-4">
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
<div class="row">
  <form action="{{ url('GenerarClavePaciente') }}" id="generarForm" method="post">
      <div class=" col-md-6 col-md-offset-3"  >
        <div class="panel panel-default panel-info">
          <div class="panel-heading">Confirmar Correo Electrónico</div>
          <div class="panel-body">
            <h4>
              {{ $paciente->Sexo = "M" ? "Bienvenido": "Bienvenida" }}  {{ $paciente->Nombre }} {{ $paciente->Apellido }}
            </h4>
            <p class="text-info">
              Al generar la nueva contraseña el sistema enviará un mail a su casilla de correo con los datos correspondientes
            </p>
              <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="form-group has-success">
                      <label class="control-label" for="email">Correo</label>
                      <input type="text" class="form-control input-error" id="email" name="email" value="{{ $paciente->Mail}}">
                      <label class="control-label" for="email">Correo Confirmación:</label>
                      <input type="text" class="form-control input-error" id="email_confirmation" name="email_confirmation">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <a href="{{ url('/') }}" type="button" name="button" class="btn btn-primary">Cancelar</a>

                  <input type="hidden" name="CodigoPaciente" value="{{ $paciente->CodigoPaciente}}">
                  <input type="hidden" name="Sexo" value="{{ $paciente->Sexo}}">
                  <input type="hidden" name="Nombre" value="{{ $paciente->Nombre}}">
                  <input type="hidden" name="Apellido" value="{{ $paciente->Apellido}}">
                  {{ csrf_field() }}
                  <button type="submit" name="button" class="btn btn-success pull-right">Generar</button>
                </div>
              </div>
            </div>
          </div>
        </div>

  </form>
</div>
@endsection
